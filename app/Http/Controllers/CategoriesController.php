<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Categories;

use Illuminate\Support\Facades\Redirect;
use DB;

class CategoriesController extends Controller
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
    public function myCategories()
    {
        return view('categoria.my-categories');
    }
    public function index(Request $request)
    {
        $categoria=Categories::latest()
        ->where('estado','=',0)
        ->paginate(5);
        return response()->json($categoria);
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
        $categoria=Categories::create($request->all());
        return response()->json($categoria);
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
        $categoria=Categories::find($id)->update($request->all());
        return response()->json($categoria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria=Categories::find($id);
        $categoria->estado=1;
        $categoria->update();
         $producto=DB::table('productos');
            $producto->where('id_cat', $id);
            $producto->update(['id_cat'=>1]);
        return response()->json($categoria);
    }
}
