<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function screen()
    {
        return $this->belongsTo(Screen::class);
    }
    public function subevents()
    {
        return $this->hasMany(Subevent::class);
    }

}
