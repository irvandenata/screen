<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screen extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
