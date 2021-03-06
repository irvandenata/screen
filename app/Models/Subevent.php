<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subevent extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

}
