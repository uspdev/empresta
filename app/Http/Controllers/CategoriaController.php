<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Categoria::orderBy('nome','asc');

        if($request->busca != null){
            $query->where('nome', 'LIKE', "%$request->busca%");
        }
        $categorias = $query->paginate(50);
        if ($categorias->count() == null) {
            $request->session()->flash('alert-danger', 'Não há registros!');
        }
        return view('categorias.index')->with('categorias',$categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoria = new Categoria;
        return view('categorias.create')->with('categoria', $categoria);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoriaRequest $request)
    {
        $validated = $request->validated();
        $categoria = Categoria::create($validated);
        return redirect("/categorias/$categoria->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit')->with('categoria', $categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $validated = $request->validated();
        $categoria->update($validated);
        return redirect("/categorias/$categoria->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect('/categorias');
    }

    public function teste()
    {
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        header('Content-Type: image/png');

        $barcode = base64_encode($generator->getBarcode('123',$generator::TYPE_CODE_128));

        #
       # echo base64_decode($barcode);

       return view('teste', [
           'barcode' => $barcode
       ]);
    }
}
