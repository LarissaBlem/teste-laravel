<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{

    public function index(Request $request)
    {
        $filtro = $request->only('genero');

        if (!empty($filtro)) {
            $pessoas = Pessoa::where('genero', $filtro['genero'])->with('carros')->orderBy('nome', 'asc')->paginate(10);
        } else {
            $pessoas = Pessoa::with('carros')->orderBy('nome', 'asc')->paginate(10);
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
