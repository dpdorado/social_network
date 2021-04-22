<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'ip',
        'created',
        'uploads',
        'like_count',
        'comment_count',
        'share_count',
        'uid'
    ];

    //Relación de muchos a 1 con user
    public function user()
    {
        return $this->belongsTo(User::class, 'uid', 'id');
    }

    //Relación de muchos a muchos con usuarios
    public function users(){
        return $this->belongsToMany(User::class, 'message_like', 'msg_id',
            'uid')->withTimestamps();
    }


}
