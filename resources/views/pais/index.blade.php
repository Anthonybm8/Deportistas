@extends('layouts.app')

@section('contenido')
<br>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Listado de Países</h1>
    <a href="{{ route('pais.create') }}" class="btn btn-outline-primary">
        <i class="fa fa-plus"></i> Nuevo País
    </a>
</div>

<div class="table-responsive">
    <table id="paisTable" class="table table-striped table-bordered align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre del País</th>
                <th>Cantidad de Deportistas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paises as $pais)
                <tr>
                    <td>{{ $pais->IdPais }}</td>
                    <td>{{ $pais->NombrePais }}</td>
                    <td>{{ $pais->deportistas->count() }}</td>
                    <td class="text-center">
                        <a href="{{ route('pais.edit', $pais->IdPais) }}" class="btn btn-outline-warning btn-sm mb-1">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form action="{{ route('pais.destroy', $pais->IdPais) }}" method="POST" class="d-inline" id="eliminar-form-{{ $pais->IdPais }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach 
        </tbody>
    </table>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#3085d6',
        });
    @endif

    document.querySelectorAll('form[id^="eliminar-form-"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    e.target.submit();
                }
            });
        });
    });

    let table = new DataTable('#paisTable', {
        paging: true,
        responsive: true,
        layout: {
            topStart: {
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            }
        },
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.3.2/i18n/es-ES.json'
        },
    });

});
</script>
@endpush

@endsection