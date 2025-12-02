<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;

class PaisController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!session('logueado')) {
                return redirect()->route('login');
            }
            return $next($request);
        });
    }
    public function index()
    {
        $paises = Pais::all();
        return view('pais.index', compact('paises'));
    }

    public function create()
    {
        return view('pais.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'NombrePais' => 'required|min:3|max:100|unique:pais,NombrePais'
        ]);

        Pais::create([
            'NombrePais' => $request->NombrePais
        ]);

        return redirect()->route('pais.index')->with('success', 'País creado exitosamente.');
    }

    public function show(string $id)
    {
        $pais = Pais::findOrFail($id);
        return view('pais.show', compact('pais'));
    }

    public function edit(string $id)
    {
        $pais = Pais::findOrFail($id);
        return view('pais.edit', compact('pais'));
    }

    public function update(Request $request, string $id)
    {
        $pais = Pais::findOrFail($id);

        $request->validate([
            'NombrePais' => 'required|min:3|max:100|unique:pais,NombrePais,' . $id . ',IdPais'
        ]);

        $pais->update([
            'NombrePais' => $request->NombrePais
        ]);

        return redirect()->route('pais.index')->with('success', 'País actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $pais = Pais::findOrFail($id);

        if ($pais->deportistas()->count() > 0) {
            return redirect()->route('pais.index')
                ->with('error', 'No se puede eliminar el país porque tiene deportistas asociados.');
        }

        $pais->delete();

        return redirect()->route('pais.index')
            ->with('success', 'País eliminado correctamente.');
    }
}