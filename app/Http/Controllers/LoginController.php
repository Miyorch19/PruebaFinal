<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6', // Eliminamos la regla 'confirmed'
        ]);
    
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
    
        $user->save();
    
        Auth::login($user);
    
        return redirect(route('privada'));
    }
    
    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6'
    ]);

    $data = [
        'name' => $request->name,
        'email' => $request->email
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
}


    public function login(Request $request){
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];
    
        $remember = ($request->has('remember') ? true : false);
    
        $user = User::where('email', $request->email)->first();
    
        if ($user && Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('privada'));
        } else {
            if (!$user) {
                return redirect('login')->with('error_email', 'El correo electrónico no está registrado.');
            } else {
                return redirect('login')->with('error_password', 'La contraseña es incorrecta.');
            }
        }
    }
    

    public function logout(Request $request)
    {
        Auth::logout();  
    
        $request->session()->invalidate();  
        $request->session()->regenerateToken();  
    
        return redirect(route('home'));  
    }
}    
