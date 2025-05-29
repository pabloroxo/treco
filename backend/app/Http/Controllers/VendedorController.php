<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vendedor\StoreVendedorRequest;
use App\Http\Requests\Vendedor\UpdateVendedorRequest;
use App\Models\Venda;
use App\Models\Vendedor;

class VendedorController extends Controller
{
    public function index()
    {
        return Vendedor::select([
            'id',
            'nome',
            'email',
        ])
            ->orderBy('nome')
            ->get();
    }

    public function show(Vendedor $vendedor)
    {
        return $vendedor;
    }

    public function store(StoreVendedorRequest $request)
    {
        return Vendedor::create($request->all())
            ->fresh();
    }

    public function update(UpdateVendedorRequest $request, Vendedor $vendedor)
    {
        $vendedor->fill($request->all());

        $vendedor->save();

        return $vendedor;
    }

    public function destroy(Vendedor $vendedor)
    {
        //TODO envoler em uma transaction
        Venda::where('vendedor_id', $vendedor->id)
            ->delete();

        return $vendedor->delete();
    }
}
