<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
  protected $table = 'mensualidades';
  protected $guarded = ['id'];
  public $timestamps = false;

  public function cliente()
  {
  	return $this->belongsTo(Cliente::class);
  }

  /**
   * METODOS DE BUSQUEDA AVANZADOS
   */
  public function scopeSearch($query, $data)
  {
    if (trim($data) != "") 
    {
    	return (
        //https://community.librenms.org/t/webui-nginx-php-7-3-error-in-laravel-framework-src-illuminate-database-query-builder-php-1229/6582/3
        $query->whereHas('cliente', function ($query) use ($data) {
          $query->where(DB::raw('CONCAT_WS(nombres," ",paterno," ",materno)'), 'like', '%'.$data.'%');
        })
      );
    }
  }

}
