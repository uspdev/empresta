<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;
use App\Models\Material;
use PDF;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('admin');
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
        $this->authorize('admin');
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
        $this->authorize('admin');
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
        $this->authorize('admin');
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
        $this->authorize('admin');
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
        $this->authorize('admin');
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
        $this->authorize('admin');
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

    public function barcode(){
        $this->authorize('balcão');
        $categorias = Categoria::orderBy('nome', 'asc')->get();
        return view('categorias.barcode')->with('categorias', $categorias);
    }

    public function barcodes(Request $request)
    {
        $this->authorize('balcão');
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $materiais = Material::orderBy('codigo', 'asc');
        if($request->categoria_id[0] == null){
            $categorias = Categoria::orderBy('nome', 'asc')->get();
            foreach($categorias as $categoria){
                $materiais->orWhere('categoria_id',$categoria->id);
            }
        }
        else{
            foreach($request->categoria_id as $categoria){
                $materiais->orWhere('categoria_id',$categoria);
            }
        }
        $materiais = $materiais->get();
        // Lógica temporária para gerar códigos de barras com 6 em cada linha
        $n = count($materiais);
        $trs = '';
        for($i=0; $i < floor($n/6)*6; $i = $i+6){
            $tr = '<tr>';
            for($j=0; $j < 6; $j++){
                $code = $materiais[$i+$j]->codigo;
                $barcode = base64_encode($generator->getBarcode($code,$generator::TYPE_CODE_128));
                $tr .= "<td><img src='data:image/png;base64,{$barcode}' width='80'> <br> {$code}</td>";
            }
            $tr .= '</tr>';
            $trs .= $tr;
        }
        // Faltantes
        $tr = '<tr>';
        for($i = floor($n/6)*6; $i < $n; $i++){
            $code = $materiais[$i]->codigo;
            $barcode = base64_encode($generator->getBarcode($code,$generator::TYPE_CODE_128));
            $tr .= "<td><img src='data:image/png;base64,{$barcode}' width='80'> <br> {$code}</td>";
        }
        $faltantes = str_repeat("<td>Null</td>", 6 - $n%6);
        $tr .= $faltantes;
        $tr .= '</tr>';
        $trs .= $tr;


        $pdf = "
            <html> <head> <style type='text/css'>
            table {
              width: 18cm;
            }
            td {
              border: 1px solid black;
              height: 1.7 cm;
              text-align: center;
            }
            tr {
            }
            </style>
            </head>
            <body><table> {$trs}</table> </body>
            </html>";

        $pdf = PDF::loadHtml($pdf)->setPaper('A4', 'portrait');
        return $pdf->download("barcodes.pdf");
    }

}
