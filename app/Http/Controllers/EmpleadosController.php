<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos['empleados'] = Empleados::paginate(1);
        return view('empleados.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Definir reglas de validación con mensajes personalizados
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255',
            'DNI' => 'required|string|max:20',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El correo electrónico no es válido.',
            'DNI.required' => 'El campo DNI es obligatorio.',
            'foto.required' => 'La foto es obligatoria.',
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, svg.',
            'foto.max' => 'La imagen no debe superar los 2 MB.',
        ]);

        // Almacenar datos del empleado
        $datosEmpleados = $validatedData;

        // Manejar la carga del archivo de foto
        if ($request->hasFile('foto')) {
            $datosEmpleados['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Empleados::create($datosEmpleados);

        return redirect()->route('empleados.index')->with('success', 'Empleado agregado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleados $empleado)
    {
        // Lógica para mostrar un empleado específico
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $empleado = Empleados::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleados::findOrFail($id);

        // Definir reglas de validación con mensajes personalizados
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'correo' => 'required|email|max:255',
            'DNI' => 'required|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'apellidos.required' => 'El campo apellidos es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'correo.required' => 'El campo correo es obligatorio.',
            'correo.email' => 'El correo electrónico no es válido.',
            'DNI.required' => 'El campo DNI es obligatorio.',
            'foto.image' => 'El archivo debe ser una imagen.',
            'foto.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, svg.',
            'foto.max' => 'La imagen no debe superar los 2 MB.',
        ]);

        $datosEmpleados = $validatedData;

        // Manejar la carga del archivo de foto
        if ($request->hasFile('foto')) {
            // Eliminar la foto anterior si existe
            if ($empleado->foto) {
                Storage::delete('public/' . $empleado->foto);
            }

            $datosEmpleados['foto'] = $request->file('foto')->store('uploads', 'public');
        } else {
            // Mantener la foto existente si no se sube una nueva
            $datosEmpleados['foto'] = $empleado->foto;
        }

        // Actualizar el empleado
        $empleado->update($datosEmpleados);

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empleado = Empleados::findOrFail($id);

        // Eliminar la foto si existe
        if ($empleado->foto) {
            Storage::disk('public')->delete($empleado->foto);
        }

        // Eliminar el empleado
        $empleado->delete();
        
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado con éxito.');
    }
}
