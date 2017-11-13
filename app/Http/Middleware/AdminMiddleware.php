<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
       if (\Auth::user()->is_admin == 1)
        {
            return $next($request);
        }else{
       \Session::flash('mensagemError','Você não está autorizado a fazer esta ação.');
           return redirect()->action('MainController@index');
       }
       
    }
}
