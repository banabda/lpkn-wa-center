<?php

namespace App\Console\Commands;

use App\Models\Dialog;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetDialogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dialogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new Client();
        $result = json_decode($client->request('GET', env('WA_URL') . 'dialogs' . env('WA_TOKEN') . '&limit=2000')->getBody()->getContents());
        // Log::info($result->dialogs);
        foreach ($result->dialogs as $res) {
            $dialog = Dialog::where('id', $res->id);
            // Log::info([$res->metadata->isGroup]);
            // Log::info([$dialog->first()]);
            if ($dialog->first()) {
                $dialog->update([
                    'name' => $res->name,
                    'image' => $res->image,
                    'last_time' => date('Y-m-d H:i:s', $res->last_time)
                ]);
            } else {
                Dialog::Create([
                    'id' => $res->id,
                    'name' => $res->name,
                    'image' => $res->image,
                    'is_group' => $res->metadata->isGroup,
                    'last_time' => date('Y-m-d H:i:s', $res->last_time)
                ]);
            }
        }
        Log::info('dialogs ok');
        return 0;
    }
}
