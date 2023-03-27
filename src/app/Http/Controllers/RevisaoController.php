<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Revisao;
use App\Models\Carro;

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

    public function edit($id)
    {
        $revisao = Revisao::where('id', $id)->with('pessoa', 'carro')->first();
        $carros = Carro::where('pessoa_id', $revisao->pessoa_id)->get();

        return view('revisao.edit', compact('revisao', 'carros'));
    }

    public function update(Request $request, Revisao $revisao)
    {

    }

    public function destroy(Revisao $revisao)
    {
        $revisao->delete();
        return redirect()->route('pessoa.index')
            ->with('success', 'Revisao removida com sucesso');
    }
}
