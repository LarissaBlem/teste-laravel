<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Carro;

class CarroController extends Controller
{
    //Se a busca for dentro de uma pessoa, retorna os carros para aquela pessoa, caso contrário lista todos os carros cadastrados.
    public function index(Request $request, $pessoa_id = null)
    {

        if ($pessoa_id == null) {
            $carros = Carro::orderBy('id', 'asc')->paginate(5);
        } else {
            $carros = Carro::where('pessoa_id', $pessoa_id)->orderBy('id', 'asc')->paginate(5);
        }
        return view('carro.index', compact('carros', 'pessoa_id'));
    }

    //Carrega a view de criação de carro atrelado a uma pessoa.
    public function create($pessoa_id)
    {
        $pessoa = Pessoa::find($pessoa_id);

        return view('carro.create', compact('pessoa'));
    }

    //Recebe e armazena os dados de carro cadastrados.
    public function store(Request $request)
    {
        Carro::create($request->all());

        return redirect()->route('pessoa.index')->with('success', 'Carro cadastrado com sucesso.');
    }

    public function edit($id)
    {
        $carro = Carro::where('id', $id)->with('pessoa')->first();
       
        $marcas = Carro::getMarcas();
        return view('carro.edit', compact("carro", "marcas"));
    }

    public function update(Request $request, Carro $carro)
    {
        $carro->update($request->all());
        $pessoa_id = $request->get('pessoa_id');

        return redirect()->route('carro.index.pessoa',['id' => $pessoa_id]);
    }    

    public function destroy(Carro $carro)
    {
        $carro->delete();

        return redirect()->route('carro.index')
            ->with('success', 'Carro removido com sucesso');
    }

    public function getCarros(Request $request)
    {
        $search = $request->proprietario_id;
        
        $carros = Carro::where('pessoa_id', $search)->orderBy('id', 'asc')->select('id', 'placa', 'modelo')->get();
           
        $response = array();
        foreach($carros as $carro){
           $response[] = array("value" => $carro->id, "label" => $carro->placa . ' / ' . $carro->modelo);
        }
   
        return response()->json($response); 
    }

}
