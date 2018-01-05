<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\Note;
use JWTAuthException;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
	{
			//$user=JWTAuth::toUser($request->token);
			$notes=Note::get();
			return response()->json(['status'=>true, 'notes'=>$notes]);
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
		$user=JWTAuth::toUser($request->token);
		$note=Note::create([
				'title'=>$request->input('title'),
				'body'=>$request->input('body'),
				'user_id'=>$user->id
		]);
		if($note){
				return response()->json(['status'=>true]);
		}
		return response()->json(['status'=>false]);
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
    public function update(Request $request)
    {
		$user=JWTAuth::toUser($request->token);
		$note=Note::where('id',$request->input('id'))->update([
			'title'=>$request->input('title'),
			'body'=>$request->input('body')
		]);
		if($note){
				return response()->json(['status'=>true]);
		}
		return response()->json(['status'=>false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
	{
		$user=JWTAuth::toUser($request->token);
		$note=Note::find($request->input('id'));
		if($note->delete()){
			return response()->json(['status'=>true]);
		}
		return response()->json(['status'=>false]);
    }
}
