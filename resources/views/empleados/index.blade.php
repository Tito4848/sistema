@extends('layouts.app')

@section('content')
<div class="container">

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('empleados.create') }}" class="btn btn-primary">Registrar nuevo empleado</a>

<table class="table table-dark">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Teléfono</th>
            <th>Correo</th>
            <th>DNI</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td>{{ $empleado->id }}</td>
            <td>
                @if($empleado->foto)
                    <img src="{{ asset('storage/' . $empleado->foto) }}" alt="Foto" style="width: 100px;">
                @else
                    No disponible
                @endif
            </td>
            <td>{{ $empleado->nombre }}</td>
            <td>{{ $empleado->apellidos }}</td>
            <td>{{ $empleado->telefono }}</td>
            <td>{{ $empleado->correo }}</td>
            <td>{{ $empleado->DNI }}</td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $empleados->links('pagination::bootstrap-4') }}


</div>
@endsection
