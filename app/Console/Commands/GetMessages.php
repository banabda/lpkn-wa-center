<?php

namespace App\Console\Commands;

use App\Models\Message;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages';

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
        $result = json_decode($client->request('GET', env('WA_URL') . 'messagesHistory' . env('WA_TOKEN') . '&count=3000')->getBody()->getContents());
        // Log::info($result->messages);
        foreach ($result->messages as $res) {
            $message = Message::where('id', $res->id);
            // if ($res->chatId == '6289653468001@c.us') {
            //     Log::info([$res->time]);
            // }
            // Log::info([$message->first()]);
            if (!$message->first()) {
                Message::Create([
                    'id' => $res->id,
                    'chatId' => $res->chatId,
                    'body' => $res->body,
                    'from_me' => $res->fromMe,
                    'type' => $res->type,
                    'author' => $res->author,
                    'caption' => isset($res->caption) ? $res->caption : null,
                    'sender_name' => $res->senderName,
                    'message_number' => $res->messageNumber,
                    'time' => date('Y-m-d H:i:s', $res->time)
                ]);
            } else {
                $message->update([
                    'id' => $res->id,
                    'chatId' => $res->chatId,
                    'body' => $res->body,
                    'from_me' => $res->fromMe,
                    'type' => $res->type,
                    'author' => $res->author,
                    'caption' => isset($res->caption) ? $res->caption : null,
                    'sender_name' => $res->senderName,
                    'message_number' => $res->messageNumber,
                    'time' => date('Y-m-d H:i:s', $res->time)
                ]);
            }
        }
        Log::info('messages ok');
        return 0;
    }
}
