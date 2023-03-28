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
        return view('relatorio.carro', compact('carros', 'homens', 'mulheres', 'marcas', 'data'));
    }


    public function marcas()
    {
        $marcas = Carro::getMarcas(true);
        $result = [];
        $marcasdb = DB::select("SELECT marca, count(marca) as total from carros GROUP BY marca order by total desc");
        
        foreach ($marcasdb as $mdb) {
            $marcas[$mdb->marca] = $mdb->total;
        }
        
        arsort($marcas);
        return $marcas;
    }
}

