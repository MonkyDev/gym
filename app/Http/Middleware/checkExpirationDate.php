<?php

namespace App\Http\Middleware;

use Closure;
use App\Suscripcion;


class checkExpirationDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $resultset = Suscripcion::get()->first();

        if ( date('Y-m-d') >= $resultset->fecha_fin ) {
            abort(405);  
        }
        return $next($request);
    }
}
