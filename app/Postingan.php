<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'postingans';

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
    protected $fillable = ['judul', 'waktu', 'konten'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }


}
