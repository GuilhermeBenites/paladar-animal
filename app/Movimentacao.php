<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $fillable = ['venda_id', 'quantidade', 'produto_id', 'razao'];
}
