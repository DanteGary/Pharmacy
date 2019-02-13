<?php

namespace App\Http\Controllers;

use App\Compras;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
   
   // public function myCompra(Request $request) {
   //     $compras = Compras::paginate(20);
   //      if($request->ajax()){
   //          return response()->json(view('compra.compras',compact('compras')->render()));
   //      }else{
          
   //      return view('compra.my-compras',compact('compras'));
   //      }
   //  }
    public function index()
    {
        $comp=\DB::select('SELECT compras.*,materiales_insumos.id id_material,materiales_insumos.nombre nombrematerial, proveedores.nombre nombrepro, proveedores.id id_proveedor FROM comprase, materialese_insumos, proveedores WHERE compras.id_material=materiales_insumos.id AND compras.id_proveedor=proveedores.id ');

        $compraS=["current_page"=>1, 'data'=>$comp, "per_page_url"=>null, "to"=>1,"total"=>1];

        $jsondata=json_encode($compraS);
        return($jsondata);
    }

   public function myCompras() {
        $materiales_insumos=\DB::table('materiales_insumos')
        ->select('*')
        ->get();
        $proveedores=\DB::table('proveedores')
        ->select('*')
        ->get();

        return view('compra.my-compras', compact('materiales_insumos'))
        ->with('proveedores',$proveedores);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $compras=Compras::create($request->all());
        return response()->json($compras);
    }

    public function show(compras $compras)
    {
        //
    }

    public function edit(compras $compras)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $compra=Compras::find($id)->update($request->all());
       return response()->json($compra);
    }


    public function destroy($id)
    {
        $compra=Compras::find($id);
        $compra->delete();
        return response()->json($compra);
    }
}
