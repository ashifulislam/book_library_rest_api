<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin-api');
    }
    public function index()
    {
        $author = DB::table('authors')
            ->orderBy('id','asc')
            ->get();
        return response()->json($author);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $author = new Author;
            $author->first_name = $request->first_name;
            $author->last_name = $request->last_name;
            $author->email = $request->email;
            $author->password=Hash::make($request->password);
        $email = Author::where('email',$request->email)->first();
        if($email)
        {
            return response()->json(['error'=>'duplicate'], 202);

        }
        else
            {

            $author->save();
            return response()->json($request);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);
        return response()->json($author);
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
        $author = Author::findOrFail($id);
        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->email = $request->email;
        $author->password=Hash::make($request->password);
        $email = Author::where('email',$request->email)->first();
        if($email)
        {
            return response()->json(['error'=>'duplicate'], 202);

        }
        else
        {

            $author->save();
            return response()->json($request);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();
        return response()->json($author);
    }
}
