<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
        ]);

        /* falta try catch y transaccion como notificacion por correo de agregacion */
        try {//registra el evento en la base de datos
            $result = DB::transaction(function () use ($request) {
                return User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password), // Password encryption
                    'role_id' => $request->role_id,
                ]);
            });

            if($result){//verifica el valor de la variable $result si tiene algo dentro lo redirecciona a la ruta de show
                /* aqui mandamos el correo */
                $subject = 'Notification de registro exitoso';
                $email = $request->email;
                $password = $request->password;
                Mail::send('emails.notification', [
                    'mailSubject' => 'Nombre de compañia',
                    'mailMessage' => 'Su registro fue',
                    'email' => $email,
                    'password' => $password,
                    'code' => 'Exitoso'
                    ], function ($message) use ($email, $subject) {
                        $message->to($email)->subject($subject);
                });

                return redirect()->route('users.index')->with('success', 'User created successfully.');
            }else {//sino redirecciona a la ruta de event con un mensaje de error
                return redirect()->route('users.index')->with('success', 'Error.');
            }

        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('success', 'Error.');
        }
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user','roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password'  => 'nullable|string|min:8|confirmed',
            'role_id'   => 'nullable|exists:roles,id', // valida que el role exista
        ]);
    
        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        
        // Actualizamos el role_id, aunque podría venir como null
        $user->role_id = $validated['role_id'] ?? null;
        
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        
        $user->save();
    
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
