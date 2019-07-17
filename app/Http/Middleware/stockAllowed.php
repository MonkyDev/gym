<?php

namespace App\Http\Middleware;

use Closure;
use App\Suscripcion;
use App\Profesionista;

class stockAllowed
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
        $registros_this_year = Profesionista::whereYear('created_at', '=', date('Y'))->get()->count();
        $resultset = Suscripcion::get()->first();

        if ( $registros_this_year >= $resultset->alojamiento )
            abort(402);

        return $next($request);
    }
}
