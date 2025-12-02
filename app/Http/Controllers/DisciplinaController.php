<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;

class DisciplinaController extends Controller
{
    public function index()
    {
        $disciplinas = Disciplina::all();
        return view('disciplina.index', compact('disciplinas'));
    }

    public function create()
    {
        return view('disciplina.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NombreDisciplina' => 'required|min:3|max:100|unique:disciplina,NombreDisciplina'
        ]);

        Disciplina::create([
            'NombreDisciplina' => $request->NombreDisciplina
        ]);

        return redirect()->route('disciplina.index')->with('success', 'Disciplina creada exitosamente.');
    }

    public function show(string $id)
    {
        $disciplina = Disciplina::findOrFail($id);
        return view('disciplina.show', compact('disciplina'));
    }

    public function edit(string $id)
    {
        $disciplina = Disciplina::findOrFail($id);
        return view('disciplina.edit', compact('disciplina'));
    }

    public function update(Request $request, string $id)
    {
        $disciplina = Disciplina::findOrFail($id);

        $request->validate([
            'NombreDisciplina' => 
                'required|min:3|max:100|unique:disciplina,NombreDisciplina,' . $id . ',IdDisciplina'
        ]);

        $disciplina->update([
            'NombreDisciplina' => $request->NombreDisciplina
        ]);

        return redirect()->route('disciplina.index')->with('success', 'Disciplina actualizada correctamente.');
    }

    public function destroy(string $id)
    {
        $disciplina = Disciplina::findOrFail($id);

        // Verificar si tiene deportistas asociados
        if ($disciplina->deportistas()->count() > 0) {
            return redirect()->route('disciplina.index')
                ->with('error', 'No se puede eliminar la disciplina porque tiene deportistas asociados.');
        }

        $disciplina->delete();

        return redirect()->route('disciplina.index')
            ->with('success', 'Disciplina eliminada correctamente.');
    }
}
