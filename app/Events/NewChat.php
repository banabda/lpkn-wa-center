<?php

namespace App\Events;

use App\Models\Dialog;
use ArrayObject;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\UserCred;
use App\Models\Message;

class NewChat implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        // Log::channel('webhook')->info(['Dialog' => Dialog::with('latestMessage')->find($this->data['chatId']), 'message' => $this->data]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }

    public function broadcastWith()
    {
        $dialog = Dialog::find($this->data['chatId']);
        $cred = UserCred::with('user', 'credential')->where('user_id', auth()->id())->first();
        if (!$dialog) {
            $dialog = (object)[];
            $dialog->id = $this->data->chatId;
            $dialog->name = $this->data->chatName;
            $dialog->image = 'https://avatars.dicebear.com/api/initials/' . $this->data->chatName . '.svg';
            $dialog->last_time = date('m/d/Y H:i:s', $this->data['time']);
            $dialog->credential_id = $cred->credential_id;
        }
        $this->data['time'] = date('m/d/Y H:i:s', $this->data['time']);
        $this->data['status'] = $this->data['fromMe'] ? 1 : 0;
        $dialog->latest_message = $this->data;
        
        $idChat = $this->data['id'];
        $message = Message::where('id', $idChat)->first();
        
        // where('id', $this->id);
        
        Log::info($this->data);

        // Log::info($message);
        // Log::info($dialog->credential_id);
        // Log::info(is_null($message) ? "Bener Kosong" : "Tidak Kosong");
        
        $chatId = $this->data['chatId'];
        $body = $this->data['body'];
        $from_me = $this->data['fromMe'];
        $type = $this->data['type'];
        $author = $this->data['author'];
        $caption = $this->data['caption'];
        $sender_name = $this->data['senderName'];
        $message_number = $this->data['messageNumber'];
        $time = $this->data['time'];

        if (is_null($message)) {
            // Log::info("Masuk Null");
            // Log::info($this->data->id);

            $createMessage = Message::Create([
                'id' => $idChat,
                'credential_id' => $dialog->credential_id,
                'chatId' => $chatId,
                'body' => $body,
                'from_me' => $from_me,
                'type' => $type,
                'author' => $author,
                'caption' => isset($caption) ? $caption : null,
                'sender_name' => $sender_name,
                'message_number' => $message_number,
                'time' => $time
            ]);

            // Log::info($createMessage);
        } 
        else {
            // Log::info("Masuk Ada Data");
            $message->update([
                'id' => $idChat,
                'credential_id' => $dialog->credential_id,
                'chatId' => $chatId,
                'body' => $body,
                'from_me' => $from_me,
                'type' => $type,
                'author' => $author,
                'caption' => isset($caption) ? $caption : null,
                'sender_name' => $sender_name,
                'message_number' => $message_number,
                'time' => $time
            ]);
        }
    
        return ['dialog' => $dialog];
    }
}
