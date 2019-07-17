<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    protected $guarded = ['id'];
    
	protected $table = 'suscripcion';

    public $timestamps = false;

}