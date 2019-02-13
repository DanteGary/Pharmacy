<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function allproductos()
    {
        $allproductos=\DB::select('select productos.*, estantes.nombre nombreST,estantes.ubicacion, categories.nombre nombrecat from productos, estantes, categories where productos.id_estante=estantes.id and productos.id_cat= categories.id and productos.estado=0');
        return view('productos.allproductos',compact('allproductos'));
    }
    public function myProductos()
    {
        $categories=\DB::table('categories')
        ->select('*')
        ->get();
        $proveedors=\DB::table('proveedors')
        ->select('*')
        ->get();
        // $capacidads=\DB::table('capacidads')
        // ->select('*')
        // ->get();
        $estantes=\DB::table('estantes')
        ->select('*')
        ->get();
        return view('productos.my-productos',compact('categories'))
        ->with('proveedors',$proveedors)
        ->with('estantes',$estantes);
        // ->with('capacidads',$capacidads);
    }

    public function myProductosStock()
    {
        $categories=\DB::table('categories')
        ->select('*')
        ->get();
        $proveedors=\DB::table('proveedors')
        ->select('*')
        ->get();
        // $capacidads=\DB::table('capacidads')
        // ->select('*')
        // ->get();
        $estantes=\DB::table('estantes')
        ->select('*')
        ->get();
        return view('productos.my-productosStock',compact('categories'))
        ->with('proveedors',$proveedors)
        ->with('estantes',$estantes);
        // ->with('capacidads',$capacidads);
    }

    public function index()
    {

        $producto=\DB::select('SELECT  productos.*,categories.nombre nombrecategories,categories.id id_cat,estantes.id id_estante,proveedors.id id_proveedor,estantes.nombre nombreestante,estantes.ubicacion ubicacion,proveedors.nombre nombreproveedor FROM productos,categories,proveedors,estantes WHERE productos.id_cat=categories.id AND productos.id_proveedor=proveedors.id AND productos.id_estante=estantes.id AND productos.estado=0 ORDER BY productos.fechavence ASC' );
        $productod=["current_page"=>1,'data'=>$producto,"per_page"=>2,"prev_page_url"=>null,"to"=>1,"total"=>1];
        $jsondata=json_encode($productod);
        return ($jsondata);
    }
    public function index2()
    {

        $producto=\DB::select('SELECT  productos.*,categories.nombre nombrecategories,categories.id id_cat,estantes.id id_estante,proveedors.id id_proveedor,estantes.nombre nombreestante,estantes.ubicacion ubicacion,proveedors.nombre nombreproveedor FROM productos,categories,proveedors,estantes WHERE productos.id_cat=categories.id AND productos.id_proveedor=proveedors.id AND productos.id_estante=estantes.id AND productos.estado=0  ORDER BY productos.cantidad ASC' );
        $productod=["current_page"=>1,'data'=>$producto,"per_page"=>2,"prev_page_url"=>null,"to"=>1,"total"=>1];
        $jsondata=json_encode($productod);
        return ($jsondata);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos=Producto::create($request->all());
        return response()->json($productos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $productos=Producto::find($id)->update($request->all());
        return response()->json($productos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productos=Producto::find($id);
        $productos->estado=1;
        $productos->update();
        return response()->json($productos);
    }
  public function reporteCompra(Request $request){
        $fechaD=$request->fechaD;
        $fechaH=$request->fechaH;
        $compraR=\DB::select("SELECT compras.*,proveedors.nombre NombreProveedor FROM compras,proveedors WHERE compras.id_proveedor=proveedors.id  AND compras.fechaReg  BETWEEN '$fechaD' AND  '$fechaH' ");
        return view('reporte.compra',['reporte'=>$compraR])->with('fechaD',$fechaD)->with('fechaH',$fechaH);
    }
}
