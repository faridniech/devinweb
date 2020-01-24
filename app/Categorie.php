<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = [

        'name', 'slug'

    ];

    protected $primaryKey = 'id';
    protected $table = 'categories';

    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }

     public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
