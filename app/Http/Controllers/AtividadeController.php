<?php

namespace App\Http\Controllers;

use App\Models\Atividade;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atividades = Atividade::paginate(10); 
        
        return view('atividades.index', compact('atividades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('atividades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_atividade' => 'required|date',
            'data_conclusao' => 'nullable|date',
            'status' => 'required|string',
            'prioridade' => 'required|string',
            'responsavel' => 'nullable|string|max:255',
            'solicitante' => 'nullable|string|max:255',
        ]);

        Atividade::create($data);

        return redirect()->route('atividades.index')->with('success', 'Atividade criada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Atividade $atividade)
    {

        return view('atividades.show', compact('atividade'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atividade $atividade)
    {
        return view('atividades.edit', compact('atividade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atividade $atividade)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_atividade' => 'required|date',
            'data_conclusao' => 'nullable|date',
            'status' => 'required|string',
            'prioridade' => 'required|integer',
            'responsavel' => 'nullable|string|max:255',
            'solicitante' => 'nullable|string|max:255',
        ]);

        $atividade->update($data);

        return redirect()->route('atividades.index')->with('success', 'Atividade atualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atividade $atividade)
    {
        $atividade->delete();
        return redirect()->route('atividades.index')->with('success', 'Atividade removida.');
    }
};