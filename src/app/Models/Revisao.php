<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revisao extends Model
{
    use HasFactory;
    protected $table = 'revisoes';
    protected $fillable = [
        'pessoa_id', 'carro_id', 'data_revisao','obs'
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }

    public function carro()
    {
        return $this->belongsTo(Carro::class);
    }
}
