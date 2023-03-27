<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carro;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'genero', 'dt_nasc','idade'
    ];

    public function carros()
    {
        return $this->hasMany(Carro::class);
    }

    static function calculaIdade($data)
    {
        $currentDate = new \DateTime('now');
        $birthDate = new \DateTime($data);
        $diff = $birthDate->diff($currentDate);
        return $diff->y;
    }
}
