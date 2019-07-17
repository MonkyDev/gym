<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Traits\CheckCustomersOwe;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        CheckCustomersOwe::alterTableClientes();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', array('instituto' => 'OPTIMUS GYM') );
    }

    public function getImage($filename){
        $file =  Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function getIcon($filename){
        $file =  Storage::disk('icons')->get($filename);
        return new Response($file, 200);
    }

}
