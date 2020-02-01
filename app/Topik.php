<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topik extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'topiks';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['topik','id','periode_id'];

    public function pesan()
    {
      return $this->hasMany(Message::class);
    }

    public function periode()
    {
      return $this->belongsTo(Periode::class);
    }

}
