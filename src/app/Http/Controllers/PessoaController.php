<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{

    public function index(Request $request)
    {
        $filtro = $request->only('genero');

        //Verifica se existe um filtro de gênero setado e se o mesmo é um gênero válido. Senão mostra todas as pessoas cadastradas.
        if (isset($filtro['genero']) && $filtro['genero'] !== null) {
            $pessoas = Pessoa::where('genero', $filtro['genero'])->with('carros')->orderBy('nome', 'asc')->get();
        } else {
            $pessoas = Pessoa::with('carros')->orderBy('nome', 'asc')->get();
        }

        return view('pessoa.index', compact('pessoas'));
    }

    public function create()
    {
        return view('pessoa.create');
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        $dados['idade'] = Pessoa::calculaIdade($dados['dt_nasc']);
        Pessoa::create($dados);
        return redirect()->route('pessoa.index')->with('success', 'Cadastro efetuado com sucesso!');
    }

    public function edit($id)
    {
        $pessoa = Pessoa::where('id', $id)->first();
       
        return view('pessoa.edit', compact("pessoa"));
    }

    public function update(Request $request, Pessoa $pessoa)
    {
        $dados = $request->all();
        $dados['idade'] = Pessoa::calculaIdade($dados['dt_nasc']);
        $pessoa->update($dados);
        return redirect()->route('pessoa.index');
    }

    public function getPessoas(Request $request)
    {
        $search = $request->search;
   
        if($search == ''){
            $pessoas = Pessoa::orderby('nome','asc')->select('id','nome')->limit(5)->get();
        } else {
            $pessoas = Pessoa::orderby('nome','asc')->select('id','nome')->where('nome', 'like', '%' .$search . '%')->limit(5)->get();
        }
   
        $response = array();
        foreach($pessoas as $pessoa){
           $response[] = array("value" => $pessoa->id, "label" => $pessoa->nome);
        }
   
        return response()->json($response); 
    }

    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();

        return redirect()->route('pessoa.index')
            ->with('success', 'Pessoa removida com sucesso');
    }
}
