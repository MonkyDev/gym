<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $guarded = ['id'];
  public $timestamps = false;

  public function mensualidades()
  {
    return $this->hasMany(Mensualidad::class);
  }

  /**
   * METODOS DE MUTACION
   */
  public function getFullNameAttribute()
  {
     return trim(ucfirst($this->nombres)) . ' ' . trim(ucfirst($this->paterno)). ' ' . trim(ucfirst($this->materno));
  }

  /**
   * METODOS DE BUSQUEDA AVANZADOS
   */
  public function scopeSearch($query,$data)
  {
    if (trim($data) != "") {
        return $query->where(DB::raw('CONCAT_WS(nombres," ",paterno," ",materno)'), 'LIKE' , '%'.$data.'%');
      }
  }

}
