<?php

namespace App\Http\Controllers;

use App\DetalleVenta;
use Illuminate\Http\Request;
use DB;

use Illuminate\Support\Facades\Auth;


class DetalleVentaController extends Controller
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
    public function myVenta(){
       
        $venta=DB::table('productos')->select('*')->where('productos.estado','=',0)->orderByRaw('productos.cantidad DESC')->get();
        return view('detalleVenta.my-venta',compact('venta'));
    }
    public function myProdSelect(){
        $venta=DB::table('productos')->select('*')->where('productos.estado','=',0)->orderByRaw('productos.cantidad DESC')->get();
        // return response()->json($venta);
        $ventad=['data'=>$venta];
        $jsondata=json_encode($ventad);
        return ($jsondata);
    }
    public function index()
    {

        $fecha=date('Y-m-d');
        $venta=DB::select("select productos.nombre nombrePro,productos.preciounitario,productos.cantidad precioUni,productos.id idpro,detalle_ventas.id idDetalleVenta,detalle_ventas.fecha fecha,detalle_ventas.cantidad cantidadVenta from productos,detalle_ventas where productos.id=detalle_ventas.id_producto and detalle_ventas.fecha='$fecha'");
        $ventad=['data'=>$venta];
        $jsondata=json_encode($ventad);
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

       
       //echo('<script> alert("adf");</script>');
        // $detalleVenta=DetalleVenta::create($request->all());
        $detalleVenta= new DetalleVenta;
        $detalleVenta->id_producto=$request->id_producto;
        $detalleVenta->fecha=$request->fecha;
        $detalleVenta->cantidad=$request->cantidad;
        $detalleVenta->id_user=Auth::user()->id;
        $detalleVenta->id_client=$request->id_client;
        $detalleVenta->estado=0;
        $detalleVenta->save();

        return response()->json($detalleVenta);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleVenta $detalleVenta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DetalleVenta  $detalleVenta
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleVenta $detalleVenta)
    {
        //
    }
    public function usuario()
    {
        $usersystem=DB::table('users')->select('*')->get();
        return view('detalleVenta.reportes',compact('usersystem'));
    }
    public function reportesventas(Request $request)
    {
       
        $usersystem=DB::table('users')->select('*')->get();
        $usersys=$request->usersys;
        $fecha1= $request->fecha1;
        $fecha2=$request->fecha2;
        $repVentas=DB::select("SELECT productos.nombre,productos.preciounitario,detalle_ventas.fecha,users.name,detalle_ventas.cantidad FROM detalle_ventas,productos,users WHERE detalle_ventas.id_producto=productos.id AND detalle_ventas.id_user=users.id AND users.id = $usersys AND detalle_ventas.estado=0 AND detalle_ventas.fecha BETWEEN '$fecha1' AND '$fecha2'");
       
    return view('detalleVenta.reportes',compact('repVentas')) ->with('usersystem',$usersystem)
             ->with('fecha1',$fecha1)
            ->with('fecha2',$fecha2)
            ->with('userss',$usersys);
    
    }
    // public function repVentas()
    // {
    //     $usersys=DB::table('users')->select('*')->get();
    //     return view('detalleVenta.reportes',compact('usersys'));
    // }

    
}
