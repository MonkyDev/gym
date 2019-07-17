<?php

namespace App\Http\Controllers\Administracion;

use App\Cliente;
use App\Mensualidad;
use Illuminate\Http\Request;
use App\History\HistorySystem;
use App\Helpers\FormatDateTime;
use App\Http\Controllers\Controller;
use App\Http\Traits\CheckCustomersOwe;
use App\Http\Controllers\Administracion\ClientesController;

class MensualidadesController extends Controller
{
    public function __construct()
    {
        CheckCustomersOwe::alterTableClientes();
        $this->middleware('permission:mensualidades.index')->only('index');
        $this->middleware('permission:mensualidades.show')->only('show');
        $this->middleware('permission:mensualidades.create')->only(['create', 'store']);
        $this->middleware('permission:mensualidades.edit')->only(['edit', 'update']);
        $this->middleware('permission:mensualidades.destroy')->only('destroy');
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
        $Mensualidades = Mensualidad::search(trim($request->keyword_search))->orderBy('created_at', 'desc')->paginate(15);
        
        return view('administracion.mensualidades.index', compact('Mensualidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Clientes = new ClientesController();

        $clientes = $Clientes->list();

        return view('administracion.mensualidades.create', array('clientes'=>$clientes));
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

            //PAGO DE MENSUALIDAD BASE
            if(Mensualidad::where('cliente_id', $request->cliente_id)->count() > 0)
                $mes_pago_base = FormatDateTime::AddMinPeriodDate('+', '1', 'month', Mensualidad::where('cliente_id', $request->cliente_id)->first()->fecha_mensualidad);
            else
                $mes_pago_base = \Carbon\Carbon::now();
            
            $Mensualidad = new Mensualidad();
            $Mensualidad->cliente_id = $request->cliente_id;
            $Mensualidad->fecha_mensualidad = $mes_pago_base;
            $Mensualidad->fecha_pago = trim($request->fecha_pago);
            $Mensualidad->monto = trim($request->monto);
            $Mensualidad->no_mes = trim($request->no_mes);
            $Mensualidad->observaciones = trim($request->observaciones);


            if ( $Mensualidad->save() ) 
            {
                $action = 'Mensualidades::create';
                $table  = 'mensualidades';

                if ( $this->history($Mensualidad, $action, $table) )
                {
                    $Cliente = Cliente::find($Mensualidad->cliente_id);
                    $Cliente->update(['estatus'=>'corriente']);
                    $action = 'Cliente::update';
                    $table  = 'clientes';
                    if ( $this->history($Cliente, $action, $table) )
                        $response = 200;
                    else
                        $response = 303; 
                }
                else    
                    $response = 303; 
            }
            else    
                $response = 302;
        
            return redirect()->route('mensualidades.index')->with('code', $response);
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
     * @param  \App\Mensualidad  $Mensualidad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $Mensualidad = Mensualidad::find($id);
            $Cliente = Cliente::find($Mensualidad->cliente_id);
            $Cliente->update(['estatus'=>'vencido']);
            $action = 'Cliente::update';
            $table  = 'clientes';
            if ( $this->history($Cliente, $action, $table) )
                $response = 200;
            else
                $response = 303;

            if ( $Mensualidad->delete() ) 
            {
                $action = 'Mensualidades::delete';
                $table  = 'mensualidades';

                if ( $this->history($Mensualidad, $action, $table) )
                    $response = 200;
                else
                    $response = 303;

            }
            else    
                $response = 302;

            return redirect()->route('mensualidades.index')->with('code', $response);
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
            $unique = "|unique:mensualidades";
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
            "cliente_id" => "required|numeric|min:1|max:9999999999",
            "fecha_pago" => "required|string|max:10",
            "monto" => 'required|numeric|min:1|max:99999999|regex:/^([0-9]{1,8})+(.[0-9]{0,2})$/',
            "observaciones" => "nullable|string|max:191",
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
