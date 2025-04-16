<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }

    public function create()
    {
        return view('types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'typename' => 'required|string|max:45',
        ]);

        Type::create($request->only('typename'));

        return redirect()->route('types.index')->with('success', 'Tipo creado exitosamente.');
    }

    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }

    public function update(Request $request, Type $type)
    {
        $request->validate([
            'typename' => 'required|string|max:45',
        ]);

        $type->update($request->only('typename'));

        return redirect()->route('types.index')->with('success', 'Tipo actualizado exitosamente.');
    }

    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('types.index')->with('success', 'Tipo eliminado.');
    }
}

