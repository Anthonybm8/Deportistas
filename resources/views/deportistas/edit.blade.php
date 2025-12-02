@extends('layouts.app')

@section('contenido')
<form action="{{ route('deportistas.update', $deportista->IdDeportista) }}" method="POST" id="formEditDeportista"
      style="max-width: 800px; margin: auto; font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    @csrf
    @method('PUT')
    <h1 class="text-center mb-4">Editar Deportista</h1>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="Nombre" class="form-label fw-bold">Nombre:</label>
            <input type="text" name="Nombre" id="Nombre" class="form-control" value="{{ $deportista->Nombre }}" required>
        </div>

        <div class="col-md-6 mb-3">
            <label for="Apellido" class="form-label fw-bold">Apellido:</label>
            <input type="text" name="Apellido" id="Apellido" class="form-control" value="{{ $deportista->Apellido }}" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="IdPais" class="form-label fw-bold">País:</label>
            <select name="IdPais" id="IdPais" class="form-select" required>
                <option value="">Seleccione un país</option>
                @foreach($paises as $pais)
                    <option value="{{ $pais->IdPais }}" {{ $deportista->IdPais == $pais->IdPais ? 'selected' : '' }}>
                        {{ $pais->NombrePais }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="IdDisciplina" class="form-label fw-bold">Disciplina:</label>
            <select name="IdDisciplina" id="IdDisciplina" class="form-select" required>
                <option value="">Seleccione una disciplina</option>
                @foreach($disciplinas as $disciplina)
                    <option value="{{ $disciplina->IdDisciplina }}" {{ $deportista->IdDisciplina == $disciplina->IdDisciplina ? 'selected' : '' }}>
                        {{ $disciplina->NombreDisciplina }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="Fecha" class="form-label fw-bold">Fecha de Nacimiento:</label>
            <input type="date" name="Fecha" id="Fecha" class="form-control" value="{{ $deportista->Fecha }}" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="Estatura" class="form-label fw-bold">Estatura (metros):</label>
            <input type="number" name="Estatura" id="Estatura" class="form-control" step="0.01" min="0.5" max="2.5" value="{{ $deportista->Estatura }}" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="Peso" class="form-label fw-bold">Peso (kg):</label>
            <input type="number" name="Peso" id="Peso" class="form-control" step="0.1" min="20" max="200" value="{{ $deportista->Peso }}" required>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <button type="submit" class="btn btn-success me-2">Actualizar</button>
        <a href="{{ route('deportistas.index') }}" class="btn btn-danger">Cancelar</a>
    </div>
</form>

@push('scripts')
<script>
$(document).ready(function() {
    $("#formEditDeportista").validate({
        rules: {
            "Nombre": { 
                required: true, 
                minlength: 2,
                maxlength: 100
            },
            "Apellido": { 
                required: true, 
                minlength: 2,
                maxlength: 100
            },
            "IdPais": { 
                required: true
            },
            "IdDisciplina": { 
                required: true
            },
            "Fecha": { 
                required: true,
                date: true
            },
            "Estatura": { 
                required: true,
                number: true,
                min: 0.5,
                max: 2.5
            },
            "Peso": { 
                required: true,
                number: true,
                min: 20,
                max: 200
            }
        },
        messages: {
            "Nombre": { 
                required: "Por favor ingresa el nombre.",
                minlength: "Mínimo 2 caracteres.",
                maxlength: "Máximo 100 caracteres."
            },
            "Apellido": { 
                required: "Por favor ingresa el apellido.",
                minlength: "Mínimo 2 caracteres.",
                maxlength: "Máximo 100 caracteres."
            },
            "IdPais": { 
                required: "Por favor selecciona un país."
            },
            "IdDisciplina": { 
                required: "Por favor selecciona una disciplina."
            },
            "Fecha": { 
                required: "Por favor ingresa la fecha de nacimiento.",
                date: "Formato de fecha inválido."
            },
            "Estatura": { 
                required: "Por favor ingresa la estatura.",
                number: "Solo se permiten números.",
                min: "La estatura mínima es 0.5m.",
                max: "La estatura máxima es 2.5m."
            },
            "Peso": { 
                required: "Por favor ingresa el peso.",
                number: "Solo se permiten números.",
                min: "El peso mínimo es 20kg.",
                max: "El peso máximo es 200kg."
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    // Establecer fecha máxima como hoy
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('Fecha').max = today;
});
</script>
@endpush
@endsection