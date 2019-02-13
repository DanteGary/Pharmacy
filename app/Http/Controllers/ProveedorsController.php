<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Proveedors;

use Illuminate\Support\Facades\Redirect;
use DB;

class ProveedorsController extends Controller
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
    public function myProveedor()
    {
        return view('proveedor.my-proveedors');
    }
    public function index(Request $request)
    {
        $proveedor=DB::table('proveedors as p')
            ->select('p.*')
            ->where('p.estado','=',0)
            ->paginate(10);
        return response()->json($proveedor);
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
        $proveedor=Proveedors::create($request->all());
        return response()->json($proveedor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $proveedor=Proveedors::find($id)->update($request->all());
        return response()->json($proveedor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor=Proveedors::find($id);
        $proveedor->estado=1;
        $proveedor->update();
         $producto=DB::table('productos');
            $producto->where('id_proveedor', $id);
            $producto->update(['id_proveedor'=>1]);
        return response()->json($proveedor);
    }
}
