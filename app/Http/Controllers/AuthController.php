<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        // Si ya está logueado, redirigir a países
        if (session('logueado')) {
            return redirect()->route('pais.index');
        }
        
        return view('login.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $usuario = $request->username;
        $password = $request->password;

        // Credenciales fijas
        if ($usuario == 'sistemas2026' && $password == 'sistemas123') {
            // Crear sesión
            session(['logueado' => true]);
            session(['username' => $usuario]);
            
            return redirect()->route('pais.index')
                ->with('success', '¡Bienvenido al sistema!');
        }

        return back()->with('error', 'Usuario o contraseña incorrectos');
    }

    public function logout()
    {
        // Destruir sesión
        session()->forget(['logueado', 'username']);
        session()->flush();
        
        return redirect()->route('login')
            ->with('success', 'Sesión cerrada exitosamente.');
    }
}