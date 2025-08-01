<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class messageController extends Controller
{
    public function changeStatus(){
        $messages = Message::all();
        $ids = $messages->pluck('id');
        foreach($ids as $id){
            $updated = Message::where('id', $id)->update([
                'status' => 'seen', 
            ]);
        }
        if($updated){
            return response()->json([
                'success' => true,
                'message' => 'Messages status updated successfully.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update messages status.'
            ]);
        }
    }
}
