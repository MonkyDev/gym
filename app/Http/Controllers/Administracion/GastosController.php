<?php

namespace App\Http\Controllers\Administracion;


use App\Gastos;
use App\Ingresos;
use Illuminate\Http\Request;
use App\History\HistorySystem;
use App\Helpers\FormatDateTime;
use App\Http\Controllers\Controller;
use App\Http\Traits\CheckCustomersOwe;

class GastosController extends Controller
{
    public function __construct()
    {
        CheckCustomersOwe::alterTableClientes();
        $this->middleware('permission:gastos.index')->only('index');
        $this->middleware('permission:gastos.show')->only('show');
        $this->middleware('permission:gastos.create')->only(['create', 'store']);
        $this->middleware('permission:gastos.edit')->only(['edit', 'update']);
        $this->middleware('permission:gastos.destroy')->only('destroy');
    }

    /**
     * Save all changes and database.
     *
     * @return \Illuminate\Http\Response
     */
    private function history($registro, $accion, $tabla)
    {
        $route  = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $ip     = $_SERVER['REMOTE_ADDR'];
        $iduser = auth()->user()->id;
        $user   = auth()->user()->name;
        $action = $accion;
        $table  = $tabla;
        $reg    = $registro;

        if (HistorySystem::create([
                'user_id'       => $iduser,
                'user_name'     => $user,
                'ip'            => $ip,
                'ruta'          => $route,
                'metodo'        => $method,
                'accion'        => $action,
                'tabla'         => $table,
                'registro'      => $reg,
                "created_at"    => \Carbon\Carbon::now(),
                "updated_at"    => \Carbon\Carbon::now()
            ])
        )

    return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $Gastos = Gastos::filter(trim($request->date_search))->whereDate('created_at', \Carbon\Carbon::now()->parse()->format('Y-m-d'))->paginate(15);
        //VARS
        $ingresos = Ingresos::filter(trim($request->date_search))->whereDate('created_at', \Carbon\Carbon::now()->parse()->format('Y-m-d'))->sum('monto');
        $gastos = Gastos::filter(trim($request->date_search))->whereDate('created_at', \Carbon\Carbon::now()->parse()->format('Y-m-d'))->sum('monto');
        $ventas = $ingresos - $gastos;

        return view('administracion.gastos.index', compact('Gastos'), array('to_ingresos'=>$ingresos, 'to_gastos'=>$gastos, 'to_ventas'=>$ventas) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this::_validation($request);

        try 
        {
            $Gasto = new Gastos();
            $Gasto->monto = trim($request->monto);
            $Gasto->concepto = trim($request->concepto);
            $Gasto->user_id = auth()->user()->id;

            if ( $Gasto->save() ) 
            {
                $action = 'Gasto::create';
                $table  = 'ingresos';

                if ( $this->history($Gasto, $action, $table) )
                    $response = 200;
                else    
                    $response = 303; 
            }
            else    
                $response = 302;

            return redirect()->route('gastos.index')->with('code', $response);
        } 
        catch (\Exception $e) 
        {
            return response()->json(
                array(
                    "response" => "error",
                    "class" => get_class($e),
                    "error" => 
                        array(
                            "code" => $e->getCode(),
                            "message" => $e->getMessage()
                        )
                )
            ); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingresos  $ingresos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            if ( $Reg = Gastos::find($id)->delete() ) 
            {
                $action = 'Gastos::delete';
                $table  = 'gastos';

                if ( $this->history($Reg, $action, $table) )
                    $response = 202;
                else
                    $response = 303;

            }
            else    
                $response = 302;

            return redirect()->route('gastos.index')->with('code', $response);
        } 
        catch (\Exception $e) 
        {
            return response()->json(
                array(
                    "response" => "error",
                    "class" => get_class($e),
                    "error" => 
                        array(
                            "code" => $e->getCode(),
                            "message" => $e->getMessage()
                        )
                )
            ); 
        }
    }

    private function _validation ($arrayable, $uniqkey = false)
    {
        if ( $uniqkey )
            $unique = "|unique:gastos";
        else
            $unique = "";

        $arrayable->validate([
            /*"matricula" => "required|numeric|min:1|max:999999999999999".$unique,
            "fechaInicio_car_m" => "required|numeric|min:1|max:99",
            "fechaInicio_car_a" => "required|numeric|min:1|max:9999",
            "fechaTerminacion_car_m" => "required|numeric|min:1|max:99",
            "fechaTerminacion_car_a" => "required|numeric|min:1|max:9999",
            "no_generacion" => "required|numeric|min:1|max:99",
            "carrera_id" => "required|numeric|min:1|max:9999999999",
            "curp" => "required|string|max:18|regex:/^[A-Z0-9]+$/".$unique,*/
            //"correoElectronico" => "required|string|max:100|email",
            //"cliente_id" => "required|numeric|min:1|max:9999999999",
            "concepto" => "nullable|string|max:191",
            "monto" => 'required|numeric|min:1|max:99999999|regex:/^([0-9]{1,8})+(.[0-9]{0,2})$/',
            //"fecha_pago" => "required|string|max:10",
            /*"nombres" => "required|string|max:191|regex:/^[A-Z0-9Ñ\s\ ]+$/",
            "paterno" => "nullable|string|max:191|regex:/^[A-Z0-9Ñ\s\ ]+$/",
            "materno" => "nullable|string|max:191|regex:/^[A-Z0-9Ñ\s\ ]+$/",
            "genero" => "required|string|max:6",
            "celular" => "nullable|string|max:10",
            "facebook" => "nullable|string|max:191",
            "activo" => "required|numeric|min:0|max:1",*/
        ]);
    }
}
