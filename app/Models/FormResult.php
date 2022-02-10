<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormResult extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
