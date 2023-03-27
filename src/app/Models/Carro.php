<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pessoa;

class Carro extends Model
{
    use HasFactory;

    protected $fillable = [
        'pessoa_id', 'placa', 'modelo','marca', 'cor'
    ];
    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    static function getMarcas($clean = false)
    {
        if ($clean) {
            return [
                'HONDA' => 0,
                'TOYOTA' => 0,
                'CHEVROLET' => 0,
                'FORD' => 0,
                'MERCEDES' => 0,
                'BMW' => 0
            ];
        } 

        return [
            'HONDA' => 'Honda',
            'TOYOTA' => 'Toyota',
            'CHEVROLET' => 'Chevrolet',
            'FORD' => 'Ford',
            'MERCEDES' => 'Mercedes',
            'BMW' => 'BMW'
        ];
    }
}
