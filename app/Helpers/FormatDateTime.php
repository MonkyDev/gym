<?php
namespace App\Helpers;

class FormatDateTime {

    public static function TimePastCurrent( $date ) {

    date_default_timezone_set('America/Mexico_City');
    $fecha1 = new \DateTime($date);
      $fecha2 = new \DateTime(date('Y-m-d H:i:s'));
      $since_start = $fecha1->diff($fecha2);

    if ($since_start->y == 0) {
      if ($since_start->m == 0) {
        if ($since_start->d == 0) {
          if ($since_start->h == 0) {
            if ($since_start->i == 0) {
              if ($since_start->s == 0) {
                $result = $since_start->s . ' segundos';
              } else {
                if ($since_start->s == 1) {
                  $result = $since_start->s . ' segundo';
                } else {
                  $result = $since_start->s . ' segundos';
                }
              }
            } else {
              if ($since_start->i == 1) {
                $result = $since_start->i . ' minuto';
              } else {
                $result = $since_start->i . ' minutos';
              }
            }
          } else {
            if ($since_start->h == 1) {
              $result = $since_start->h . ' hora';
            } else {
              $result = $since_start->h . ' horas';
            }
          }
        } else {
          if ($since_start->d == 1) {
            $result = $since_start->d . ' día';
          } else {
            $result = $since_start->d . ' días';
          }
        }
      } else {
        if ($since_start->m == 1) {
          $result = $since_start->m . ' mes';
        } else {
          $result = $since_start->m . ' meses';
        }
      }
    } else {
      if ($since_start->y == 1) {
        $result = $since_start->y . ' año';
      } else {
        $result = $since_start->y . ' años';
      }
    }

    return "Hace " . $result;
  }


  public static function DiffDiasBetweenTwoDates($fecha_one, $fecha_two)
    {
        /*Validar los datos*/
        $date_one = empty($fecha_one) ? date('Y-m-d') : $fecha_one;
        $date_two = empty($fecha_two) ? date('Y-m-d') : $fecha_two;

        /*Saber si es timestamp o fecha normal*/
        $date_one_p = strlen($date_one)>10 ? explode(' ', $date_one) : $date_one;
        $date_two_p = strlen($date_two)>10 ? explode(' ', $date_two) : $date_two;

        /*determinar si la fecha se partió fecha y tiempo*/
        $date_out_one = is_array($date_one_p) ? $date_one_p[0] : $date_one_p;
        $date_out_two = is_array($date_two_p) ? $date_two_p[0] : $date_two_p;

        $dias = ( strtotime($date_out_one) - strtotime($date_out_two) ) / 86400;
        $dias = abs($dias);
        $dias_transcu = floor($dias);

    return  (int) $dias_transcu;
    }

    public static function DiffDiasBetweenTwoDatesLV($date_ini, $date_fin)
    {
        $days = 0;
        $total_days = \FormatDateTime::daysAgo($date_ini, $date_fin);

        for ($i=0; $i <= (int)$total_days; $i++)
        {
            $one_date = \FormatDateTime::AddMinPeriodDate('+', $i, 'days', $date_ini);
            $literal_dia = \FormatDateTime::letraDia($one_date);

            if ( $literal_dia === 'D' || $literal_dia === 'S')
                continue;
            else
                ++$days;
        }

    return $days;
    }


  public static function FechaNowWithCountryLetras()
  {
    $dia = date("d");
    $mes = date("m");
    $year = date("Y");
    $matmes = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
        "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
        "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

  return  "Tuxtla GutiÃ©rrez, Chiapas; " . $matmes[$mes] . " " . $dia . " de " . $year;
  }
  /**
   *
   *
   * ESTA FUNCION NOS PERMITE OBTENER MES O AÑO ANTERIOR
  */
  public static function SubMonthAndYear($month = 0,$year = 0)
  {
    $mes = date('m',strtotime("-". $month ."month"));
    $year = date('Y',strtotime("-". $year ."year"));
    $matmes = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
        "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
        "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

    return  $matmes[$mes] ."-".$year;
  }

  /**
   *
   *
   * ESTA FUNCION NOS PERMITE OBTENER MES O AÑO ANTERIOR
  */
  public static function getMonthYear($date)
  {

    list($year,$month, $day) = explode('-', $date);

    $matmes = array("01" => 'Enero', "02" => 'Febrero', "03" => 'Marzo', "04" => 'Abril',
        "05" => 'Mayo', "06" => 'Junio', "07" => 'Julio', "08" => 'Agosto', "09" => 'Septiembre',
        "10" => 'Octubre', "11" => 'Noviembre', "12" => 'Diciembre');

    return  $matmes[$month] ."-".$year;
  }


  /*formato de fecha con letras y hora*/
  public static function DateDMA($Fecha, $hora=false, $letras=false)
  {
      if ( is_null($Fecha) || $Fecha=='')
        return '00/00/0000';

      /*Saber si es timestamp o fecha normal*/
      $date_explod = strlen($Fecha)>10 ? explode(' ', $Fecha) : $Fecha;

      /*determinar si la fecha se particionó en fecha y tiempo*/
      $any_date = is_array($date_explod) ? $date_explod[0] : $date_explod;

      /*extraemos solo los datos de la fecha*/
      $datos = explode("-", $any_date);
      $dia = $datos[2];
      $mes = $datos[1];
      $year = $datos[0];

      if($year==='0000' || $mes==='00' || $dia==='00')
        return 'La Fecha, no puede ser 0000-00-00';

      /*Saber si se quiere incluir hora en la fecha*/
      if (!empty($hora))
        /*saber si ay time en la fecha*/
        $time_end = is_array($date_explod) ? $date_explod[1] : date('H:s:i');
      else
        $time_end = '';

      /*Arreglo de meses en letras*/
      $matmes = [
          "01" => 'Enero',
          "02" => 'Febrero',
          "03" => 'Marzo',
          "04" => 'Abril',
          "05" => 'Mayo',
          "06" => 'Junio',
          "07" => 'Julio',
          "08" => 'Agosto',
          "09" => 'Septiembre',
          "10" => 'Octubre',
          "11" => 'Noviembre',
          "12" => 'Diciembre'
      ];


      /*Determinar el sufijo por el año*/
      $sufijo = ($year > 1999) ? " del " : " de ";

      /*saber si la fecha se quiere en letras o no*/
      if($letras && $hora)
        $date_end = $dia . " de " . $matmes[$mes] . $sufijo . $year. " a las " .$time_end. " horas.";
      elseif($letras && !$hora)
        $date_end = $dia . " de " . $matmes[$mes] . $sufijo . $year;
      else
        $date_end = $dia . "/" . $mes . "/" . $year. " " .$time_end;

      /*Asignamos valores finales*/
      $salida = trim($date_end);

    return $salida;
  }

  //SUMA O RESTA DIAS A UNA FECHA
  public static function AddMinPeriodDate($sign, $number, $period, $date)
  {
    $newDate = strtotime ( $sign.$number.' '.$period, strtotime($date) );
    $newDate = date ( 'Y-m-d' , $newDate );

    return $newDate;
  }

  //TIEMPO A TRANSCURRIR ENTRE 2 FECHAS
  public static function TimeAgo($fechaInicio, $fechaFin, $time=false)
  {
    $fecha1 = new \DateTime($fechaInicio);
    $fecha2 = new \DateTime($fechaFin);
    $fecha = $fecha1->diff($fecha2);
    $tiempo = "";

    //años
    if($fecha->y > 0)
    {
        $tiempo .= $fecha->y;

        if($fecha->y == 1)
            $tiempo .= " año, ";
        else
            $tiempo .= " años, ";
    }


    //meses
    if($fecha->m > 0)
    {
        $tiempo .= $fecha->m;

        if($fecha->m == 1)
            $tiempo .= " mes, ";
        else
            $tiempo .= " meses, ";
    }

    //dias
    if($fecha->d > 0)
    {
        $tiempo .= $fecha->d;

        if($fecha->d == 1)
            $tiempo .= " día, ";
        else
            $tiempo .= " días, ";
    }

    if($time)
    {
      //horas
      if($fecha->h > 0)
      {
          $tiempo .= $fecha->h;

          if($fecha->h == 1)
              $tiempo .= " hora, ";
          else
              $tiempo .= " horas, ";
      }

      //minutos
      if($fecha->i > 0)
      {
          if( strlen($fecha->i) == 1 )
            $tiempo .= '0'.$fecha->i;
          else
            $tiempo .= $fecha->i;

          if($fecha->i == '01')
              $tiempo .= " minuto";
          else
              $tiempo .= " minutos";
      }
      else if($fecha->i == 0) //segundos
          $tiempo .= $fecha->s." segundos";
    }

    return rtrim($tiempo, ', ');
  }

  //ANOS TRANSCURRIDOS ENTRE 2 FECHAS
  public static function yearsAgo($fechaInicio, $fechaFin=false)
  {
    $fecha1 = new \DateTime($fechaInicio);
    $fechaFin ? $fecha2 = new \DateTime($fechaFin) : $fecha2 = new \DateTime(date('Y-m-d'));
    $fecha = $fecha1->diff($fecha2);

    //años
    if($fecha->y > 0)
        $tiempo = $fecha->y;
    else
      $tiempo = "0";

    return $tiempo;
  }

  //ANOS TRANSCURRIDOS ENTRE 2 FECHAS
  public static function daysAgo($fechaInicio, $fechaFin=false)
  {
    $fecha1 = new \DateTime($fechaInicio);
    $fechaFin ? $fecha2 = new \DateTime($fechaFin) : $fecha2 = new \DateTime(date('Y-m-d'));
    $fecha = $fecha1->diff($fecha2);

    //dias
    if($fecha->d > 0)
        $tiempo = $fecha->d;
    else
      $tiempo = "0";

    return $tiempo;
  }

  public static function letraDia($fecha)
  {

    $dias = array('D', 'L', 'M', 'X', 'J', 'V', 'S');

    $dia = $dias[ date('w', strtotime($fecha) ) ];

    return $dia;

  }

}
