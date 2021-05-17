<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = Nota::where('state',1)->get();


        $notas = DB::table('users')
        ->select(
            'notas.*',
            'users.name as user_nombre'
        )
        ->join('notas','notas.user_id','users.id')
        ->where('notas.state',1)->get();
        return response()->json([
            'notas' => $notas,
        ]);
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
        $idEdit = 0;
        if($request->id == 0){
            $nota = new Nota();
        }else{
            $nota = Nota::find($request->id);
            $idEdit = $nota->id;
        }
        $nota->description = $request->description;
        $nota->creation_date = $request->date ;
        $nota->user_id = 1;
        $user = User::find(1);
        if($nota->save()):
            return response()->json(['status' => 200, 'msg' => 'Nota creada con éxito', 'notaP' => $nota, 'idEdit' => $idEdit, 'user' => $user]);
        else:
            return response()->json(['status' => 500, 'msg' => 'Algo salió mal',]);
        endif;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function edit(Nota $nota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return response()->json(['request' => $request->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return response()->json(['nota' => $request->all()]);
        $nota = Nota::find($request->id);
        $nota->state = 3;
        if($nota->save()):
            return response()->json(['status' => 200, 'msg' => 'Nota eliminada con éxito',]);
        else:
            return response()->json(['status' => 500, 'msg' => 'Algo salió mal',]);
        endif;
    }
}
