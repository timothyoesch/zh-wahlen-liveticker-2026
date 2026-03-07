<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Observers\BotmessageObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([BotmessageObserver::class])]
class Botmessage extends Model
{
    use Notifiable;

    protected $fillable = [
        'title',
        'content',
        'message_id',
        'sent_at',
    ];

}
