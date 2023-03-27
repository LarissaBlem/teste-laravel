<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function pessoas(Request $request)
    {
        $pessoas = Pessoa::orderBy('nome', 'asc')->paginate(5);

        // $homens = DB::select('SELECT COUNT(*) as total FROM pessoas where genero=?', ['M']);

        $homens = Pessoa::selectRaw('COUNT(id) as total, AVG(idade) as media')
            ->where('genero', 'M')
            ->first();

        $mulheres = Pessoa::selectRaw('COUNT(id) as total, AVG(idade) as media')
            ->where('genero', 'F')
            ->first();
        return view('relatorio.pessoa', compact('homens', 'mulheres', 'pessoas'));
    }
}
