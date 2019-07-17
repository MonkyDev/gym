<?php
namespace App\Helpers;
  
class FunctionsEspecials {


	static function calculaEdadWithNacimientoNS($fecha_nacimiento){

	    $birth = $fecha_nacimiento; // nacimiento
	    $fbir = explode('-', $birth); // particionamos la fecha f[0]=año f[1]=mes f[2]=dia
	    $bir = array(
	        'a'=>$fbir[0],
	        'm'=>$fbir[1],
	        'd'=>$fbir[2]
	    );
	    $edad = date('Y') - $bir['a']; // nos basamos en el año para obtener la edad actual
	    if( date('m') >= $bir['m'] ) // mes actual cumple es mayor o igual al actual
	    { 
	      	if( date('d') < $bir['d'] )
	      	{ //dia cumple es menor al actual aun faltan dias
		        $edad--;
		        return $edad;
	      	}else if(  date('d') >= $bir['d'] ) // dia cumple es mayor o igual al actual ya los cumplio
	        	return $edad; //

	    } else { // mes cumple es menor actual faltan meses
	      $edad--;
	      return $edad;
	    }
	}

	static function CalculaEdad($fecha_nacimiento)
	{
    	$fecha_actual = date('Y-m-d');

		// separamos en partes las fechas 
		$array_nacimiento = explode ( "-", $fecha_nacimiento ); 
		$array_actual = explode ( "-", $fecha_actual ); 

	   $anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años 
	   $meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
	   $dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días 

		//ajuste de posible negativo en $días 
		if ($dias < 0) 
   		{ 
      		--$meses; 

			//ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual 
			switch ($array_actual[1]) { 
        		case 1: 
            		$dias_mes_anterior=31;
            	break; 
         		case 2:     
	            	$dias_mes_anterior=31;
	            break; 
	         	case 3:  
			    $bisiesto=false; 
			   	//probamos si el mes de febrero del año actual tiene 29 días 
			    if (checkdate(2,29,$array_actual[2])) 
	      			$bisiesto=true; 
	             
	            if ($bisiesto) 
	            { 
	               $dias_mes_anterior=29;
	               break; 
	            }
	            else 
	            { 
	               $dias_mes_anterior=28;
	               break; 
	            } 
				case 4:
					$dias_mes_anterior=31;
				break; 
				case 5:
					$dias_mes_anterior=30;
				break; 
				case 6:
					$dias_mes_anterior=31;
				break; 
				case 7:
					$dias_mes_anterior=30;
				break; 
				case 8:
					$dias_mes_anterior=31;
				break; 
				case 9:
					$dias_mes_anterior=31;
				break; 
				case 10:
					$dias_mes_anterior=30;
				break; 
				case 11:
					$dias_mes_anterior=31;
				break; 
				case 12:
					$dias_mes_anterior=30;
				break; 
      	} 

      	$dias=$dias + $dias_mes_anterior;

	    if ($dias < 0)
	    {
	        --$meses;
	       	if($dias == -1)
	        	$dias = 30;
	        if($dias == -2)
	        	$dias = 29;
	    }
   	}

	//ajuste de posible negativo en $meses 
	if ($meses < 0) 
	{ 
		--$anos; 
		$meses=$meses + 12; 
	}

	$tiempo[0] = $anos;
	$tiempo[1] = $meses;
	$tiempo[2] = $dias;

   	return $tiempo[0];
	}


	static function Bisiesto($anio_actual){ 
	   	$bisiesto=false; 
	   	//probamos si el mes de febrero del año actual tiene 29 días 
	    if (checkdate(2,29,$anio_actual)) 
	    	$bisiesto=true; 
	return $bisiesto; 
	}





}