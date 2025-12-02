<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deportista;
use App\Models\Pais;
use App\Models\Disciplina;

class DeportistaController extends Controller
{
    // Agrega este constructor al INICIO de la clase
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session('logueado')) {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }
    // Tu código ORIGINAL sigue igual desde aquí
    public function index()
    {
        $deportistas = Deportista::with(['pais', 'disciplina'])->get();
        return view('deportistas.index', compact('deportistas'));
    }

    public function create()
    {
        $paises = Pais::all();
        $disciplinas = Disciplina::all();
        return view('deportistas.new', compact('paises', 'disciplinas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required|min:2|max:100',
            'Apellido' => 'required|min:2|max:100',
            'IdPais' => 'required|exists:pais,IdPais',
            'IdDisciplina' => 'required|exists:disciplina,IdDisciplina',
            'Fecha' => 'required|date',
            'Estatura' => 'required|numeric|min:0.5|max:2.5',
            'Peso' => 'required|numeric|min:20|max:200'
        ]);

        Deportista::create([
            'Nombre' => $request->Nombre,
            'Apellido' => $request->Apellido,
            'IdPais' => $request->IdPais,
            'IdDisciplina' => $request->IdDisciplina,
            'Fecha' => $request->Fecha,
            'Estatura' => $request->Estatura,
            'Peso' => $request->Peso
        ]);

        return redirect()->route('deportistas.index')
            ->with('success', 'Deportista creado exitosamente.');
    }

    public function show(string $id)
    {
        $deportista = Deportista::with(['pais', 'disciplina'])->findOrFail($id);
        return view('deportistas.show', compact('deportista'));
    }

    public function edit(string $id)
    {
        $deportista = Deportista::findOrFail($id);
        $paises = Pais::all();
        $disciplinas = Disciplina::all();

        return view('deportistas.edit', compact('deportista', 'paises', 'disciplinas'));
    }

    public function update(Request $request, string $id)
    {
        $deportista = Deportista::findOrFail($id);

        $request->validate([
            'Nombre' => 'required|min:2|max:100',
            'Apellido' => 'required|min:2|max:100',
            'IdPais' => 'required|exists:pais,IdPais',
            'IdDisciplina' => 'required|exists:disciplina,IdDisciplina',
            'Fecha' => 'required|date',
            'Estatura' => 'required|numeric|min:0.5|max:2.5',
            'Peso' => 'required|numeric|min:20|max:200'
        ]);

        $deportista->update([
            'Nombre' => $request->Nombre,
            'Apellido' => $request->Apellido,
            'IdPais' => $request->IdPais,
            'IdDisciplina' => $request->IdDisciplina,
            'Fecha' => $request->Fecha,
            'Estatura' => $request->Estatura,
            'Peso' => $request->Peso
        ]);

        return redirect()->route('deportistas.index')
            ->with('success', 'Deportista actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $deportista = Deportista::findOrFail($id);
        $deportista->delete();

        return redirect()->route('deportistas.index')
            ->with('success', 'Deportista eliminado correctamente.');
    }
}