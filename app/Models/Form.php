<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function subevent()
    {
        return $this->belongsTo(subevent::class);
    }
    public function subforms()
    {
        return $this->hasMany(Subform::class);
    }
    public function formresults()
    {
        return $this->hasMany(FormResult::class);
    }
}
