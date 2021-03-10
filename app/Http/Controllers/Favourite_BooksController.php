<?php

namespace App\Http\Controllers;


use App\Book;
use App\UserFavouriteBooks;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Array_;

class Favourite_BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function add_favourite_book(Request $request)
    {
        $user_id = Auth::user()->id;
        $book_id = $request->id;

        if (UserFavouriteBooks::where('book_id', '=', $book_id)
                ->where('user_id','=',$user_id)->count() > 0) {
            return response()->json(['error'=>'already added'], 200);

        }
        else{

            $favourite_book = new UserFavouriteBooks();
            $favourite_book->user_id = $user_id;
            $favourite_book->book_id = $book_id;
            $favourite_book->save();
            return response()->json(['success'=>'completed'], 201);

        }

    }
    public function show_favourite_book()
    {
        $user_id = Auth::user()->id;
        $books = UserFavouriteBooks::orderBy('id', 'asc')
            ->where('user_id','=',$user_id)->get();
        $marge_item = [];
        foreach($books as $book)
        {
            $items = DB::table('books')->where('id',$book->book_id)->first();
            $marge_item []= $items;

        }

       return response()->json($marge_item);
    }
}
