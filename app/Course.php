<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	protected $fillable = ['name', 'categorie_id','description','slug' ];
	
	protected $table = 'courses';
	protected $primaryKey = 'id';

	public function category()
	{
		return $this->belongsTo('App\Categorie','categorie_id');
	}

	public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}
