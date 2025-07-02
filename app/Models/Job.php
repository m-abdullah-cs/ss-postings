<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes,HasFactory;
    protected $fillable = [
        'title',
        'description',
        'budget',
        'timeline',
        'client_id',
    ];

     public function proposals(){
        return $this->hasMany(Proposal::class);
     }

     public function client(){
        return $this->belongsTo(User::class);
     }
}
