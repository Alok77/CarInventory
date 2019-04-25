<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
     protected $table = 'models';

  public function Manufacturer(){
  	return $this->belongsTo('App\Manufacturer', 'Manufacturer_id');
  }
  public function images(){
  	return $this->hasMany('App\Image', 'model_id', 'id');
  }
}
