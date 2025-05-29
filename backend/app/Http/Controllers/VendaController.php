<?php

namespace App\Http\Controllers;

// use App\Http\Requests\Venda\StoreVendaRequest;
// use App\Http\Requests\Venda\UpdateVendaRequest;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index(Request $request)
    {
        return Venda::select([
            'id',
            'vendedor_id',
            'valor',
            'data_venda',
        ])
            ->with(['vendedor' => function ($query) {
                $query->select('id', 'nome');
            }])
            ->when($request->vendedor_id, function ($query) use ($request) {
                $query->where('vendedor_id', $request->vendedor_id);
            })
            ->when($request->data_venda, function ($query) use ($request) {
                $query->whereDate('data_venda', $request->data_venda);
            })
            ->orderBy('data_venda', 'desc')
            ->orderBy('vendedor_id')
            ->get();
    }

    public function show(Venda $venda)
    {
        $venda->load('vendedor');

        return $venda;
    }

    public function store(/*StoreVenda*/Request $request)
    {
        $dados = $request->all();

        $dados['valor'] = str_replace(',', '.', $dados['valor']);

        return Venda::create($dados)
            ->fresh();
    }

    public function update(/*UpdateVenda*/Request $request, Venda $venda)
    {
        $dados = $request->all();

        $dados['valor'] = str_replace(',', '.', $dados['valor']);

        $venda->fill($dados);

        $venda->save();

        return $venda;
    }

    public function destroy(Venda $venda)
    {
        return $venda->delete();
    }
}
