<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Vendedor;

class ComissaoController extends Controller
{
    public function index(Vendedor $vendedor)
    {
        //TODO retornar a soma e as comissões de um vendedor sem uma data
    }

    public function show(Vendedor $vendedor, $data_venda)
    {
        //TODO retornar a soma e as comissões de um vendedor com uma data
    }
}
