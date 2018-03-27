<?php
namespace App\Providers;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class QueueServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Queue::before(function (JobProcessing $event) {
            Log::channel('queue')->info('Processing {job} on {connectionName}', [
                'status' => 'processing',
                'job' => $event->job->payload()['displayName'] ?? get_class($event->job),
                'connectionName' => $event->connectionName,
            ]);
        });

        Queue::after(function (JobProcessed $event) {
            Log::channel('queue')->info('Processed {job} on {connectionName}', [
                'status' => 'done',
                'job' => $event->job->payload()['displayName'] ?? get_class($event->job),
                'connectionName' => $event->connectionName,
            ]);
        });

        Queue::failing(function (JobFailed $event) {
            Log::channel('queue')->error('Failed {job} on {connectionName}', [
                'status' => 'failed',
                'job' => $event->job->payload()['displayName'] ?? get_class($event->job),
                'connectionName' => $event->connectionName,
                'exceptionMessage' => $event->exception->getMessage(),
                'expection' => $event->exception,
            ]);
        });
    }
}
