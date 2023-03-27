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
            ->groupBy(DB::raw('id,genero'))
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
        
            // Assignment::select('id','batch_id','title','description','attachment','last_submission_date',DB::raw('(CASE WHEN type = 9 THEN "Quiz Type"  ELSE "Descriptive" END) AS assignment_type'),DB::raw('(CASE WHEN status = 1 THEN "Assigned"  ELSE "Not Assigned" END) AS status'))
            //           ->with('assignmentBatch:id,batch_number')
            //           ->where('assignments.instructor_id',auth('api')->user()->id)
            //           ->orderBy('created_at','DESC');
        
        return view('relatorio.carro', compact('carros'));
    }
}
