<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    
    protected $guarded = [];
   
    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function topik()
    {
      return $this->belongsTo(Periode::class);
    }

}
