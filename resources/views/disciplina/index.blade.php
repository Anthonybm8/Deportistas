@extends('layouts.app')

@section('contenido')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Listado de Disciplinas</h1>
    <a href="{{ route('disciplina.create') }}" class="btn btn-outline-primary">
        <i class="fa fa-plus"></i> Nueva Disciplina
    </a>
</div>

<div class="table-responsive">
    <table id="disciplinaTable" class="table table-striped table-bordered align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre de la Disciplina</th>
                <th>Cantidad de Deportistas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplinas as $disciplina)
                <tr>
                    <td>{{ $disciplina->IdDisciplina }}</td>
                    <td>{{ $disciplina->NombreDisciplina }}</td>
                    <td>{{ $disciplina->deportistas->count() }}</td>
                    <td class="text-center">
                        <a href="{{ route('disciplina.edit', $disciplina->IdDisciplina) }}" class="btn btn-outline-warning btn-sm mb-1">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form action="{{ route('disciplina.destroy', $disciplina->IdDisciplina) }}" method="POST" class="d-inline" id="eliminar-form-{{ $disciplina->IdDisciplina }}">
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

    let table = new DataTable('#disciplinaTable', {
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