<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $clients=Clients::latest()
        ->paginate(10);
        return response()->json($clients);
    }
    public function getData()
    {
        $clientes=\DB::select('SELECT  clients.* FROM clients ORDER BY clients.id DESC' );
        $cliented=['data'=>$clientes];
        $jsondatacli=json_encode($cliented);
        return ($jsondatacli);
    }
    public function myClientes(){
        return view('clientes.my-clientes');
    }
     public function buscar(Request $request)
    {
        $nit=$request->nit;
        $clients=\DB::table('clients')
        ->select('*')
        ->where('clients.nit','=',$nit)
        ->get();
        
        return view('detalleVenta.create',compact('clients'));
        // ->with('capacidads',$capacidads);
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
        $clients=Clients::create($request->all());
        return response()->json($clients);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Clients $clients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clients $clients)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $clients)
    {
        //
    }
}
