<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = ['type','photo','temps','prix','point'];

    public function appointments()
    {
        return $this->hasOneThrought(Appointment::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
