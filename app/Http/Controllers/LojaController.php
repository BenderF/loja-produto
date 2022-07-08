<?php

namespace App\Http\Controllers;

use App\Http\Requests\LojaRequest;
use App\Models\Loja;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Loja::with('produtos')->get(), 200);
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
                'nome_loja' => 'required|min:3|max:40|string',
                'email' => 'required|unique:loja|email',
            ]);

            $loja = new Loja;
            $loja->nome_loja = $data['nome_loja'];
            $loja->email = $data['email'];
            $loja->save();
            return response($loja, 201);
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
        return response(Loja::where('id', $id)->with('produtos')->get(), 200);
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
        try{
            $data = $request->validate([
                'nome_loja' => 'required|min:3|max:40|string',
                'email' => 'unique:loja|email',
            ]);

            $loja = Loja::find($id);
            $loja->nome_loja = $data['nome_loja'];
            $loja->email = $data['email'];
            $loja->save();

            return response($loja, 200);
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
            return response(Loja::destroy($id));
    }
}
