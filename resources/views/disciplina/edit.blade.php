@extends('layouts.app')

@section('contenido')
<form action="{{ route('disciplina.update', $disciplina->IdDisciplina) }}" method="POST" id="formEditDisciplina"
      style="max-width: 700px; margin: auto; font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    @csrf
    @method('PUT')
    <h1 class="text-center mb-4">Editar Disciplina</h1>

    <div class="mb-3">
        <label for="NombreDisciplina" class="form-label fw-bold">Nombre de la Disciplina:</label>
        <input type="text" name="NombreDisciplina" id="NombreDisciplina" class="form-control" value="{{ $disciplina->NombreDisciplina }}" required>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success me-2">Actualizar</button>
        <a href="{{ route('disciplina.index') }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@push('scripts')
<script>
$(document).ready(function() {
    $("#formEditDisciplina").validate({
        rules: {
            "NombreDisciplina": { 
                required: true, 
                minlength: 3,
                maxlength: 100
            }
        },
        messages: {
            "NombreDisciplina": { 
                required: "Por favor ingresa el nombre de la disciplina.", 
                minlength: "Mínimo 3 caracteres.",
                maxlength: "Máximo 100 caracteres."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
</script>
@endpush
@endsection