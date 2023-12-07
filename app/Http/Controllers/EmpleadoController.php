<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\EmpleadoRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;




class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $empleados = Empleado::all();
        return view('panel.empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleado = new Empleado(); // o cualquier lógica para obtener el modelo empleado
        return view('panel.empleados.create', compact('empleado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmpleadoRequest $request)
    {
        $request->validate([
            'dni' => 'required|unique:empleados,dni',
            'nombre' => 'required',
            'apellido' => 'required',
            'domicilio' => 'nullable',
            'telefono' => 'nullable',
            'correo' => 'required|email|unique:empleados,correo',
            'password' => 'required|min:6',
        ]);
    
        // Crea el usuario con el rol de vendedor
        $user = User::create([
            'name' => $request->input('nombre'),  // Puedes cambiar esto según tus necesidades
            'email' => $request->input('correo'), // Usa el campo 'correo' para el correo electrónico del usuario
            'password' => Hash::make($request->input('password')),
        ]);
        $vendedorRole = Role::where('name', 'vendedor')->first();
        $user->assignRole($vendedorRole);
    
        // Crea el empleado y vincula al usuario
        $empleado = Empleado::create($request->all());
        $empleado->user_id = $user->id;
        $empleado->save();
    
        return redirect()->route('empleado.index')
            ->with('success', 'Empleado y cuenta creados exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        return view('panel.empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $empleado)
    {
        return view('panel.empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmpleadoRequest $request, Empleado $empleado)
    {
        $request->validate([
            'dni' => 'required|unique:empleados,dni,' . $empleado->id,
            'nombre' => 'required',
            'apellido' => 'required',
            'domicilio' => 'nullable',
            'telefono' => 'nullable',
            'correo' => 'nullable|unique:empleados,correo,' . $empleado->id,
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleado.index')
            ->with('success', 'Empleado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleado.index')
            ->with('success', 'Empleado eliminado exitosamente.');
    }
}