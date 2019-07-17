<?php

namespace App\Http\Controllers\Administracion;
use App\Cliente;
use Illuminate\Http\Request;
use App\History\HistorySystem;
use App\Http\Controllers\Controller;
use App\Http\Traits\CheckCustomersOwe;
use Illuminate\Support\Facades\Storage;

class ClientesController extends Controller
{
    public function __construct()
    {
        CheckCustomersOwe::alterTableClientes();
        $this->middleware('permission:clientes.index')->only('index');
        $this->middleware('permission:clientes.show')->only('show');
        $this->middleware('permission:clientes.create')->only(['create', 'store']);
        $this->middleware('permission:clientes.edit')->only(['edit', 'update']);
        $this->middleware('permission:clientes.destroy')->only('destroy');
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
    public function index(Request $request, $choose = null)
    {
        if($choose)
            $Clientes = Cliente::search(trim($request->keyword_search))->where('estatus', $choose)->orderBy('created_at', 'desc')->paginate(20);
        else
            $Clientes = Cliente::search(trim($request->keyword_search))->orderBy('created_at', 'desc')->paginate(20);

        return view('administracion.clientes.index', compact('Clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this::_validation($request, true);

        try 
        {

            //Calculamos edad Con Laravel
            if ($request->nacimiento)
                $calc_edad = \Carbon\Carbon::parse($request->nacimiento)->age;
            else
                $calc_edad = 0;
            
            $Cliente = new Cliente();
            $Cliente->nombres = trim($request->nombres);
            $Cliente->paterno = trim($request->paterno);
            $Cliente->materno = trim($request->materno);
            $Cliente->genero = trim($request->genero);
            $Cliente->celular = trim($request->celular);
            $Cliente->facebook = trim($request->facebook);
            $Cliente->nacimiento = trim($request->nacimiento);
            $Cliente->edad = $calc_edad;
            $Cliente->fecha_inscripcion = $request->fecha_inscripcion ? trim($request->fecha_inscripcion) : \Carbon\Carbon::now();
            $Cliente->estatus = 'corriente';

            if( $file = $request->file('foto_perfil') )
            {
                $datas_img = "";

                if(
                    $file->getClientMimeType() === 'image/jpeg' ||
                    $file->getClientMimeType() === 'image/jpg' ||
                    $file->getClientMimeType() === 'image/png' 
                )
                {
                
                    $file_upload = $file;

                    $extension = strtolower($file->getClientOriginalExtension());

                    $fileName = uniqid(). '.' .$extension;

                    Storage::disk('images_clientes')->put($fileName, \File::get($file_upload));

                    $Cliente->foto_perfil = 'app/public/Media/Images/Clientes/'.$fileName;
                }
                else
                    die('El formato de imagen es incorrecto');
            }
            else
                $Cliente->foto_perfil = 'app/public/images/avatar/avatar.png';

            if ( $Cliente->save() ) 
            {
                $action = 'Clientes::create';
                $table  = 'clientes';

                if ( $this->history($Cliente, $action, $table) )
                    $response = 200;
                else    
                    $response = 303; 
            }
            else    
                $response = 302;
        
            return redirect()->route('clientes.index')->with('code', $response);
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
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $Cliente)
    {
        return view('administracion.clientes.show', compact('Cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $Cliente)
    {
        return view('administracion.clientes.edit', compact('Cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $Cliente)
    {
        $this::_validation($request, true);
        
        try
        {

            //Calculamos edad Con Laravel
            if ($request->nacimiento)
                $calc_edad = \Carbon\Carbon::parse($request->nacimiento)->age;
            else
                $calc_edad = 0;
            
            $Cliente->nombres = trim($request->nombres);
            $Cliente->paterno = trim($request->paterno);
            $Cliente->materno = trim($request->materno);
            $Cliente->genero = trim($request->genero);
            $Cliente->celular = trim($request->celular);
            $Cliente->facebook = trim($request->facebook);
            $Cliente->nacimiento = trim($request->nacimiento);
            $Cliente->edad = $calc_edad;
            $Cliente->fecha_inscripcion = $request->fecha_inscripcion ? trim($request->fecha_inscripcion) : \Carbon\Carbon::now();
            $Cliente->estatus = 'corriente';
            $Cliente->activo = trim($request->activo);

            if ( $Cliente->update() ) 
            {
                $action = 'Clientes::update';
                $table  = 'clientes';

                if ( $this->history($Cliente, $action, $table) )
                    $response = 201;
                else    
                    $response = 303; 
            }
            else    
                $response = 302;
        
            return redirect()->route('clientes.index')->with('code', $response);
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
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $Cliente)
    {
        try
        {
            if ( $Cliente->delete() ) 
            {
                $action = 'Clientes::delete';
                $table  = 'clientes';

                if ( $this->history($Cliente, $action, $table) )
                    $response = 202;
                else    
                    $response = 303; 
            }
            else    
                $response = 302;

            return redirect()->route('clientes.index')->with('code', $response);

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
            $unique = "|unique:clientes";
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
            "nombres" => "required|string|max:191|regex:/^[A-Z0-9Ñ\s\ ]+$/",
            "paterno" => "nullable|string|max:191|regex:/^[A-Z0-9Ñ\s\ ]+$/",
            "materno" => "nullable|string|max:191|regex:/^[A-Z0-9Ñ\s\ ]+$/",
            "genero" => "required|string|max:6",
            "celular" => "nullable|string|max:10",
            "facebook" => "nullable|string|max:191",
            "nacimiento" => "required|string|max:10",
            "activo" => "required|numeric|min:0|max:1",
        ]);
    }


    static public function list()
    {
        $registros = array(0 => 'Seleccionar');

        $registros_db = Cliente::all()->sortBy('paterno')->sortBy('materno');

        foreach ($registros_db as $reg)
            $registros += array($reg->id => $reg->full_name);

        return $registros;
    }
}
