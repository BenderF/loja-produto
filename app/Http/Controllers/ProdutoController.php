<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\Email;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Produto::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nome' => 'required',
                'valor' => 'required|integer',
                'loja_id' => 'required|integer',
                'ativo' => 'required|bool'
            ]);

            $produto = new Produto;
            $produto->nome = $data['nome'];
            $produto->valor = $data['valor'];
            $produto->loja_id = $data['loja_id'];
            $produto->ativo = $data['ativo'];
            $produto->save();

            $body = "O produto $produto->nome foi adicionado ao banco de dados!";

            dispatch(new SendEmailJob($body));

            return response($produto, 201);
        } catch (\Throwable $exception) {
            return response($exception->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response(Produto::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->validate([
                'nome' => 'required',
                'valor' => 'required|integer',
                'loja_id' => 'required|integer',
                'ativo' => 'required|bool'
            ]);

            $produto = Produto::find($id);

            $produto->nome = $data['nome'];
            $produto->valor = $data['valor'];
            $produto->loja_id = $data['loja_id'];
            $produto->ativo = $data['ativo'];
            $produto->save();

            $body = "O produto $produto->nome foi atualizado no banco de dados!";

            dispatch(new SendEmailJob($body));

            return response($produto, 200);
        } catch (\Throwable $exception) {
            return response($exception->getMessage(), 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response(Produto::destroy($id), 200);
    }
}
