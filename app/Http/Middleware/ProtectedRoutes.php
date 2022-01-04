<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProtectedRoutes
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if(count($roles) > 0){

            foreach($roles as $role) {

                $rol = $this->getRol($role);

                if(auth()->user()->roles->rol == $rol){
                    return $next($request);
                }
            }

            return redirect('no-autorizado');

        }else{

            $rol = $this->getRol($roles[0]);

            if(auth()->user()->roles->rol == $rol){
                return $next($request);
            }

            return redirect('no-autorizado');
        }
    }

    public function getRol($role){
        switch ($role) {
            case 'A':
                return 'Administrador';
                break;
            case 'JL':
                return 'Jefe de Línea';
                break;
            case 'EA':
                return 'Encargado de almacén';
                break;
            case 'V':
                return 'Vendedor';
                break;
            default:
                return '';
                break;
        }
    }
}
