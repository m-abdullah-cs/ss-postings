<?php

namespace App\Livewire;

use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class NotificationComponent extends Component
{
    public int $userId;
    public $notificationSMS;
    public function mount()
    {
        $this->userId = Auth::id();
    }

    #[On('echo:smsNotification-channel.{userId},SMSNotificationEvent')]
    public function listenToBroadcastedMessage($event)
    {
        $this->notificationSMS = $event;
    }
    public function render()
    {
        return view('livewire.notification-component');
    }
}
