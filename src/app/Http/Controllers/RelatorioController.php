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

        //Molde para gráfico do relatório.
        $data['label'][] = 'Homens';
        $data['data'][] = $homens;

        $data['label'][] = 'Mulheres';
        $data['data'][] = $mulheres;

        $data['chart-data'] = json_encode($data);
        
        $marcas = $this->marcas();

        $marcas_genero = $this->marcas_genero();
        return view('relatorio.carro', compact('carros', 'homens', 'mulheres', 'marcas', 'data', 'marcas_genero'));
    }

    public function revisoes()
    {
        //Carregas as marcas (em carros) que possuem revisões e ordena pela quantidade de revisões.
        $marcas = DB::select(
            DB::raw(
                "SELECT COUNT(R.id) as total, marcas.nome  from marcas
                INNER JOIN carros as C ON marcas.id = C.marca_id
                INNER JOIN revisoes as R ON C.id = R.carro_id
                GROUP BY marcas.id
                ORDER BY total DESC"
            )
        );

        //Carrega as pessoas que possuem revisões, agrupando por pessoa, com o total de revisões e ordena pela quantidade.
        $pessoas  = DB::select(
            DB::raw(
                "SELECT COUNT(C.id) as total, P.nome  from pessoas as P
                INNER JOIN carros as C ON P.id = C.pessoa_id
                INNER JOIN revisoes as R ON C.id = R.carro_id
                GROUP BY P.id
                ORDER BY total DESC"
            )
        );

        $revisoes_pessoas = $this->revisoes_pessoas();
        return view('relatorio.revisao', compact('marcas', 'pessoas', 'revisoes_pessoas'));
    }


    public function revisoes_pessoas()
    {
        $pessoas = Pessoa::with('revisoes')->get();

        $data_anterior = false;
        $report = [];

        //Para cada pessoa, verifica se existem revisões.
        foreach ($pessoas as $pessoa) {
            $data_anterior = false;
            if (!empty($pessoa->revisoes)) {
                //Se não houver revisões anteriores não existe média.
                if ($pessoa->revisoes->count() <= 1) {
                    $report[$pessoa->id] = [
                        'nome' => $pessoa->nome,
                        'media' => "0",
                        'proxima' => 'Sem informações para cálculo.'
                    ];
                //Se houverem mais revisões, extrai as revisoes da pessoa para um array.    
                } else {
                    $datas = $pessoa->revisoes->pluck('data_revisao')->toArray();
                    $array_diff = [];
                    foreach ($datas as $data) {
                        if (!$data_anterior) {
                            $data_anterior = $data;
                        } else {
                            $a = new \Datetime($data_anterior);
                            $b = new \Datetime($data);

                            $diff = $b->diff($a)->days;
                            $array_diff[] = $diff;
                            $data_anterior = $data;
                        }
                    }
                    //Calcula a média
                    $media = (number_format(array_sum($array_diff)/count($array_diff)));
                    
                    //Padroniza pra relatório o nome da pessoa, a média de dias e a próxima data, baseada na média.
                    $report[$pessoa->id] = [
                        'nome' => $pessoa->nome,
                        'media' => $media,
                        'proxima' => $b->modify("+{$media} days")->format('Y-m-d')
                    ];  
                }
            }
            
        }
        return $report;
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

