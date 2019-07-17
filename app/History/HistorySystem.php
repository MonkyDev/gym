<?php

namespace App\History;

use Illuminate\Database\Eloquent\Model;

class HistorySystem extends Model
{
    protected $table = 'history_system';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
		'user_name',
		'ip',
		'ruta',
		'metodo',
		'accion',
		'tabla',
		'registro'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

}
