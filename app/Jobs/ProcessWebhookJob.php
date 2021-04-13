<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Log;
use \Spatie\WebhookClient\ProcessWebhookJob as SpatieProcessWebhookJob;

class ProcessWebhookJob extends SpatieProcessWebhookJob
{
    public function handle()
    {
        $data = json_decode($this->webhookCall, true);

        Log::channel('webhook')->info('Starting webhook');
        Log::channel('webhook')->info($data);
    }
}
