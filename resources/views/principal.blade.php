@extends('layouts.app')

@section('titulo')
Crear Expedientes
@endsection

@section('contenido')
<form action="{{route('expedientes')}}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Asunto</label>
        <textarea name="asunto" class="form-control @error('asunto') is-invalid @enderror"></textarea>
        @error('asunto')
        <div class=" invalid-feedback d-block text-center">{{ $message }} </div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Fecha de Inicio</label>
        <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror">
        @error('fecha_inicio')
        <div class=" invalid-feedback d-block text-center">{{ $message }} </div>
        @enderror
    </div>

    <div class="mb-4">
        <label for="id_estatus" class="form-label fw-bold text-uppercase text-secondary">Estatus</label>
        <select id="id_estatus" name="id_estatus" class="form-select">
            @foreach($estatus as $es)
            <option value="{{ $es->id }}">{{ $es->nombre }}</option>
            @endforeach
        </select>
    </div>

    <input type="hidden" name="id_usuario_registra">

    <button type="submit" class="btn btn-primary">Guardar</button>

</form>

<hr>



<div class="container mt-4">


<h2 class="mb-4">Busqueda de Expedientes</h2>

<form method="GET" action="{{ route('expedientes.buscar') }}">
    @csrf
    <div class="mb-3">
        <label for="estatus" class="form-label">Estatus</label>
        <select id="estatus" name="estatus" class="form-select">
            <option value="">Seleccionar estatus</option>
            @foreach ($estatus as $es)
                <option value="{{ $es->id }}" {{ old('estatus') == $es->id ? 'selected' : '' }}>
                    {{ $es->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="row">

        <div class="col-md-6 col-12 mb-3">
            <label for="fecha_inicio_desde" class="form-label">Fecha de inicio desde</label>
            <input type="date" class="form-control" id="fecha_inicio_desde" name="fecha_inicio_desde" value="{{ old('fecha_inicio_desde') }}">
        </div>

        <div class="col-md-6 col-12 mb-3">
            <label for="fecha_inicio_hasta" class="form-label">Fecha de inicio hasta</label>
            <input type="date" class="form-control" id="fecha_inicio_hasta" name="fecha_inicio_hasta" value="{{ old('fecha_inicio_hasta') }}">
        </div>
    </div>

    <div class="mb-3">
        <label for="busqueda" class="form-label">Número de expediente o Asunto</label>
        <input type="text" class="form-control" id="busqueda" name="busqueda" value="{{ old('busqueda') }}">
    </div>

    <button type="submit" class="btn btn-primary">Buscar</button>
    <!-- Botón de reset -->
    <button type="reset" class="btn btn-secondary" onclick="window.location.href='{{ route('expedientes.buscar') }}';">Resetear</button>
</form>


<hr>



    <div class="table-responsive">



        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>NO. Expediente</th>
                    <th>Asunto</th>
                    <th>Fecha de Inicio</th>
                    <th>Estatus</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expedientes as $expediente)
                    <tr>
                        <td>{{ $expediente->numero_expediente }}</td>
                        <td>{{ $expediente->asunto }}</td>
                        <td>{{ $expediente->fecha_inicio }}</td>
                        <td>{{ $expediente->estatus->nombre }}</td>
                        <td>{{ $expediente->usuario->nombre }}</td>
                        <td>

                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-asunto="{{ $expediente->asunto }}"
                                    data-fecha="{{ $expediente->fecha_inicio }}"
                                    data-estatus="{{ $expediente->estatus->nombre }}"
                                    data-id="{{ $expediente->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>



                            <form action="{{ route('expedientes.softDelete', $expediente->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')

                                @if(Auth::user()->role->id == 1)
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este expediente?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                                @endif
                            </form>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>


    <div class="d-flex justify-content-between">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm mb-0">
            {{ $expedientes->onEachSide(1)->links('pagination::bootstrap-4') }}
        </ul>
    </nav>
    </div>

       <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Expediente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
    <form id="editForm" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="asunto_update" class="form-label">Asunto</label>
            <input type="text" class="form-control @error('asunto_update') is-invalid @enderror" id="asunto_update" name="asunto_update">
            @error('asunto_update')
            <div class="invalid-feedback d-block text-center">{{ $message }}</div>
            @enderror
        </div>

    <div class="mb-3">
        <label for="fecha_inicio_update" class="form-label">Fecha de Inicio</label>
        <input type="date" class="form-control @error('fecha_inicio_update') is-invalid @enderror" id="fecha_inicio_update" name="fecha_inicio_update">
        @error('fecha_inicio_update')
        <div class="invalid-feedback d-block text-center">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="id_estatus" class="form-label fw-bold">Estatus</label>
        <select id="id_estatus" name="id_estatus" class="form-select">
            @foreach($estatus as $es)
            <option value="{{ $es->id }}">{{ $es->nombre }}</option>
            @endforeach
        </select>
    </div>

    <input type="hidden" id="expediente_id" name="expediente_id">

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
</form>

                </div>
            </div>
        </div>
    </div>

</div>


<script>
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var asunto = button.getAttribute('data-asunto');
        var fecha = button.getAttribute('data-fecha');
        var estatus = button.getAttribute('data-estatus');
        var id = button.getAttribute('data-id');


        document.getElementById('asunto_update').value = asunto;
        document.getElementById('fecha_inicio_update').value = fecha;
        document.getElementById('id_estatus').value = estatus;
        document.getElementById('expediente_id').value = id;


        var formAction = "{{ route('expedientes.update') }}";

        document.getElementById('editForm').action = formAction;
    });
</script>


@endsection
