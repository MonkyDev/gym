<?php

namespace App\Http\Traits;

use App\Cliente;
use App\Mensualidad;
use App\Helpers\FormatDateTime;

trait CheckCustomersOwe
{
    /**
     * Get device on user.
     *
     * @param null
     *
     * @return owes
     */
    public static function alterTableClientes()
    {
        $Clientes = Cliente::all();
        foreach ($Clientes as $Cliente)
        {
            //CALCULAMOS EL MES SIGUIENTE A PARTIR DEL ULTIMO PAGO
            //2019-06-08 INICIA
            //2019-07-08 CADUCA
            //2019-07-14 HOY
            //
            if ($Cliente->mensualidades->count() > 0)
            {
                $prox_mes = FormatDateTime::AddMinPeriodDate('+', '1', 'month', $Cliente->mensualidades->last()->fecha_mensualidad);

                if (
                    strtotime(date('Y-m-d')) >= strtotime($Cliente->mensualidades->last()->fecha_mensualidad) &&
                    strtotime(date('Y-m-d')) >= strtotime($prox_mes)
                )
                    $Cliente->update(['estatus'=>'vencido']);
            }
            else
                continue;

        }
    }

}
