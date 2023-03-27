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
}
