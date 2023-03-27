<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revisao;

class RevisaoController extends Controller
{

    public function index()
    {
        $revisoes = Revisao::with('pessoa', 'carro')->orderBy('id', 'asc')->paginate(5);
        return view('revisao.index', compact('revisoes'));
    }
    public function create()
    {
        return view('revisao.create');
    }

    public function store(Request $request)
    {
        Revisao::create($request->all());

        return redirect()->route('pessoa.index')->with('success', 'Carro cadastrado com sucesso.');
 
    }

    public function edit(Request $request, Revisao $revisao)
    {

    }

    public function destroy(Revisao $revisao)
    {
        
    }
}
