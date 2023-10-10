<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request) {

        // Récupère les crédentials
        $credentials=$request->validated();

        // Test si les credentials sont bons
        if (\Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regénére un id de session
            return redirect()->intended(route('admin.property.index'));
        }

        // Sinon retourne sur le login avec une erreur
        return back()->withErrors([
            'email' => 'Identifiants incorrect'
        ])->onlyInput('email');
    }

    public function logout() {
        \Auth::logout();
        return to_route('home')->with('success','Vous êtes maintenant déconnecté');
    }
}
