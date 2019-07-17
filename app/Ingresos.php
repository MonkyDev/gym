<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
  protected $table = 'ingresos';
  protected $guarded = ['id'];
  public $timestamps = false;

  public function usuario()
  {
  	return $this->belongsTo('App\User', 'user_id');
  }

  /**
   * METODOS DE BUSQUEDA AVANZADOS
   */
  public function scopeFilter($query, $data)
  {
    if (trim($data) != "") {
      return $query->whereDate('created_at', $data);
    }
  }

}
