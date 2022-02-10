<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $guarded = [];
    public static function record($user_id = null, $event, $extra)
    {
        return static::create([
            'user_id' => is_null($user_id) ? null : $user_id->id,
            'ip' => request()->ip(),
            'event' => $event,
            'extra' => $extra,
        ]);
    }
}
