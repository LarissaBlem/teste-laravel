<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use App\Models\Carro;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function pessoas(Request $request)
    {
        $pessoas = Pessoa::select('*')
            ->groupBy(DB::raw('genero, id'))
            ->get();

        $homens = Pessoa::selectRaw('COUNT(id) as total, AVG(idade) as media')
            ->where('genero', 'M')
            ->first();

        $mulheres = Pessoa::selectRaw('COUNT(id) as total, AVG(idade) as media')
            ->where('genero', 'F')
            ->first();
        return view('relatorio.pessoa', compact('homens', 'mulheres', 'pessoas'));
    }

    public function carros()
    {
        $carros = Carro::select("*", 'pessoas.*')
            ->join('pessoas', 'carros.pessoa_id', '=', 'pessoas.id')
            ->groupBy(DB::raw('carros.id,pessoas.id'))
            ->orderBy(DB::raw('pessoas.nome'))
            ->get();

        $homens = DB::select("SELECT COUNT(pessoas.id) as total FROM pessoas
        INNER JOIN carros ON pessoas.id = carros.pessoa_id AND pessoas.genero='M'");

        $homens = $homens[0]->total;

        $mulheres = DB::select("SELECT COUNT(pessoas.id) as total FROM pessoas
        INNER JOIN carros ON pessoas.id = carros.pessoa_id AND pessoas.genero='F'");

        $mulheres = $mulheres[0]->total;

        $data['label'][] = 'Homens';
        $data['data'][] = $homens;

        $data['label'][] = 'Mulheres';
        $data['data'][] = $mulheres;

        $data['chart-data'] = json_encode($data);
        
        $marcas = $this->marcas();

        $marcas_genero = $this->marcas_genero();
        return view('relatorio.carro', compact('carros', 'homens', 'mulheres', 'marcas', 'data', 'marcas_genero'));
    }


    public function marcas()
    {
        $marcasdb = DB::select(DB::raw("SELECT COUNT(C.id) as total, marcas.nome  from marcas
        INNER JOIN carros as C ON marcas.id = C.marca_id
        GROUP BY marcas.id
        ORDER BY total DESC"));

        return $marcasdb;
    }

    public function marcas_genero()
    {
        $marcasdb = DB::select(DB::raw("SELECT COUNT(C.id) as total, marcas.nome, P.genero  from marcas
        INNER JOIN carros as C ON marcas.id = C.marca_id
		INNER JOIN pessoas as P ON C.pessoa_id = P.id
        GROUP BY   P.genero, marcas.id
		ORDER BY total DESC"));

        return $marcasdb;
    }
}

