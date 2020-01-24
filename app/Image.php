<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    
    //protected $fillable = ['file_name', 'imageable_type','imageable_id'];
	protected $table = 'images';
	protected $primaryKey = 'id';

	public function imageable()
    {
        return $this->morphTo();
    }
}
