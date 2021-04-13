<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use \Spatie\WebhookClient\ProcessWebhookJob as SpatieProcessWebhookJob;

class ProcessWebhookJob extends SpatieProcessWebhookJob
{
    public function handle()
    {
        $data = json_decode($this->webhookCall, true);

        Log::channel('cron')->info('Starting webhook');
        Log::channel('cron')->info($data);
    }
}
