<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Livewire;
use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Events\SendMessageEvent;
use App\Events\SMSNotificationEvent;
use Illuminate\Support\Facades\Auth;

class ChatComponent extends Component
{
    public $job_id;
    public $proposal_id;
    public $notification = '';
    public $user;
    public $sender_id;
    public $receiver_id;
    public $message = '';
    public $messages = [];

     public function render()
    {
        return view('livewire.chat-component');
         
    }
   

    public function mount($user_id, $job_id, $proposal_id){
        $this->job_id = $job_id;
        $this->proposal_id = $proposal_id;
        $this->sender_id = Auth::user()->id;
        $this->receiver_id = $user_id;
        $messages = Message::where(function($query){
            $query->where('sender_id', $this->sender_id)
            ->where('receiver_id', $this->receiver_id);
        })->orWhere(function($query){
            $query->where('sender_id', $this->receiver_id)
            ->where('receiver_id', $this->sender_id);
        })
        ->with('sender:id,name', 'receiver:id,name','sender.profile:user_id,picture', 'receiver.profile:user_id,picture')
        ->get();
        foreach($messages as $message){
            $this->appendMessage($message);
        }   
        $this->user = User::where('id', $user_id)->first();
       
    }


    public function sendMessage(){  
        $this->notification =  $this->message;
        $chatMessage = new Message;
        $chatMessage->sender_id = $this->sender_id;
        $chatMessage->receiver_id = $this->receiver_id;
        $chatMessage->job_id = $this->job_id;
        $chatMessage->proposal_id = $this->proposal_id;
        $chatMessage->message = $this->message;
        $chatMessage->save();
        
        $this->appendMessage($chatMessage);
        broadcast(new SendMessageEvent($chatMessage))->toOthers();

        broadcast(new SMSNotificationEvent($chatMessage));

        $this->message = '';
        
    }


    #[On('echo-private:chat-channel.{sender_id},SendMessageEvent')]
    public function listenForMessage($event){
        $chatMessage = Message::whereId($event['message']['id'])->with('sender:id,name', 'receiver:id,name')->first();
        $this->appendMessage($chatMessage);
        
    }
    public function appendMessage($message){
        $senderFullName = $message->sender->name; // e.g. "Client+Sara"
         $senderPicture = $message->sender?->profile?->picture;

            $senderName = null;
             if ($senderPicture == null) {
        $parts = explode('+', $senderFullName);
        if (count($parts) == 2) {
            $senderName = strtoupper(substr($parts[0], 0, 1) . substr($parts[1], 0, 1));
        } else {
            $senderName = strtoupper(substr($senderFullName, 0, 1)); // fallback
        }
    }
        $this->messages[] = [
            'id'=> $message->id,
            'sender' => $senderFullName,
            'receiver' => $message->receiver->name,
            'message' => $message->message,
            'sender_picture' => $message->sender?->profile?->picture,
            'receiver_picture' => $message->receiver?->profile?->picture,
            'sender_name' => $senderName, // Will be null if picture exists
        ];
    }
}
