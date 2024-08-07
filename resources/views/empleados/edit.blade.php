@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Empleado</h1>

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Campo de nombre -->
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre', $empleado->nombre) }}" id="nombre" class="form-control">
        </div>

        <!-- Campo de apellidos -->
        <div class="form-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" value="{{ old('apellidos', $empleado->apellidos) }}" id="apellidos" class="form-control">
        </div>

        <!-- Campo de teléfono -->
        <div class="form-group">
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" value="{{ old('telefono', $empleado->telefono) }}" id="telefono" class="form-control">
        </div>

        <!-- Campo de correo -->
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" name="correo" value="{{ old('correo', $empleado->correo) }}" id="correo" class="form-control">
        </div>

        <!-- Campo de DNI -->
        <div class="form-group">
            <label for="DNI">DNI:</label>
            <input type="text" name="DNI" value="{{ old('DNI', $empleado->DNI) }}" id="DNI" class="form-control">
        </div>

        <!-- Campo de foto -->
        <div class="form-group">
            <label for="foto">Foto:</label>
            @if(isset($empleado) && $empleado->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $empleado->foto) }}" alt="Foto actual" class="img-thumbnail" style="width: 100px; height: auto;">
                </div>
            @endif
            <input type="file" name="foto" id="foto" class="form-control-file">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Guardar datos</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">Regresar</button>
        </div>
    </form>
</div>
@endsection
