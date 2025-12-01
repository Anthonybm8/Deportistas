@extends('layouts.app')

@section('contenido')
<br>
<form action="{{ route('pais.update', $pais->IdPais) }}" method="POST" id="formEditPais"
      style="max-width: 700px; margin: auto; font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    @csrf
    @method('PUT')
    <h1 class="text-center mb-4">Editar País</h1>

    <div class="mb-3">
        <label for="NombrePais" class="form-label fw-bold">Nombre del País:</label>
        <input type="text" name="NombrePais" id="NombrePais" class="form-control" value="{{ $pais->NombrePais }}" required>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-success me-2">Actualizar</button>
        <a href="{{ route('pais.index') }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@push('scripts')
<script>
$(document).ready(function() {
    $("#formEditPais").validate({
        rules: {
            "NombrePais": { 
                required: true, 
                minlength: 3,
                maxlength: 100
            }
        },
        messages: {
            "NombrePais": { 
                required: "Por favor ingresa el nombre del país.", 
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