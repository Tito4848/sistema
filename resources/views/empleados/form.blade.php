<h1 class="mb-4">Crear Empleado</h1>

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

<form action="{{ route('empleados.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Campo de nombre -->
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}" id="nombre" class="form-control">
    </div>

    <!-- Campo de apellidos -->
    <div class="form-group">
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" value="{{ old('apellidos') }}" id="apellidos" class="form-control">
    </div>

    <!-- Campo de teléfono -->
    <div class="form-group">
        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" value="{{ old('telefono') }}" id="telefono" class="form-control">
    </div>

    <!-- Campo de correo -->
    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" value="{{ old('correo') }}" id="correo" class="form-control">
    </div>

    <!-- Campo de DNI -->
    <div class="form-group">
        <label for="DNI">DNI:</label>
        <input type="text" name="DNI" value="{{ old('DNI') }}" id="DNI" class="form-control">
    </div>

    <!-- Campo de foto -->
    <div class="form-group">
        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto" class="form-control-file">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Guardar datos</button>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
</form>