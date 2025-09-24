<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class VerifyIsSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $data_user = User::with('role')->findOrFail(Auth::user()->id);

        if($data_user->role->role_name != 'superadmin'){
            Session::flash('message', 'Anda Tidak memiliki akses ke halaman ini');
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
