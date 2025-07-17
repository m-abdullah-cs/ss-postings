<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('chat-channel.{user_id}', function(User $user, $user_id){

    return (int) $user->id === (int) $user_id;
});



Broadcast::channel('smsNotification-channel.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId;
});
