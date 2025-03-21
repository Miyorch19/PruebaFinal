<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; // Importamos este Log

class UserController extends Controller
{
    public function index()
    {
        Log::info('Se accedió a la lista de usuarios.');
        $users = User::all();
        return view('usuarios', compact('users'));
    }

    public function create()
    {
        Log::info('Se accedió al formulario de creación de usuario.');
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Log::info('Usuario creado:', ['id' => $user->id, 'email' => $user->email]);

        return redirect()->route('users.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit(User $user)
    {
        Log::info('Se accedió a la edición del usuario:', ['id' => $user->id]);
        return view('usuarios.edit', compact('user'));
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
    
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
            Log::info('Contraseña actualizada para el usuario:', ['id' => $user->id]);
        }
    
        $user->update($data);
        Log::info('Usuario actualizado:', ['id' => $user->id, 'email' => $user->email]);

        $message = $request->password ? 'Usuario y contraseña actualizados correctamente.' : 'Usuario actualizado correctamente.';
    
        return redirect()->route('users.index')->with('success', $message);
    }

    public function destroy(User $user)
    {
        Log::warning('Usuario eliminado:', ['id' => $user->id, 'email' => $user->email]);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
