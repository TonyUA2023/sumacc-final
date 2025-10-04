<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Permitir acceso a Admin, Manager y Staff
        $allowedRoles = ['Admin', 'Manager', 'Staff'];
        if (!in_array(auth()->user()->role, $allowedRoles)) {
            return redirect()->route('dashboard')->with('error', 'No tienes permisos para acceder a esta área.');
        }

        return $next($request);
        // En el método getAvailableSlots, modifica para obtener la zona horaria del header
        $userTimezone = $request->header('X-User-Timezone', 'UTC');
    }
}