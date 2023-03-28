<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Carro;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function carros()
    {
        $this->hasMany(Carro::class);
    }

}
