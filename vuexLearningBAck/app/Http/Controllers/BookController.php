<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
class BookController extends Controller
{
    //
    public function book(){
        return Book::get();
    }

    public function searchBook(Request $request)
    {
        $book = Book::query();
        $book->where('is_available' == 1)->where('stock' <= 0);
        if($request->input('searchkey')!=""){
            $keyword = $request->input('searchkey');
            $book->where(function($query)use($keyword){
                $query  ->where('book_id', 'LIKE', "%$keyword%")
                        ->where('book_name', 'LIKE', "%$keyword%")
                        ->where('book_description', 'LIKE', "%$keyword%");
            });
            return $book->orderBy('book_name', 'desc')->get();
        }
    }
    public function book_pagination(Request $request) {
        $book = Book::query();
        $book->where('is_available', '!=', 0)->where('stock', '!=', 0);
        if($request->input('keyword') != ""){
            $keyword = $request->input('keyword');
            $book->where(function($query) use($keyword){
                $query   ->where('book_name', 'LIKE', "%$keyword%");
                      
            });
        }
        return $book->orderBy('book_name', 'desc')->paginate(10);

        // return Book::get();

    }

    public function add_book (Request $request) {
        $book = New Book;
        $request->validate([
            'book_id' => 'required',
            'book_name' => 'required',
            'book_description' => 'required',
            'stock' => 'required',
        ]);
        $book->book_id = $request->book_id;
        $book->book_name = $request->book_name;
        $book->book_description = $request->book_description;
        $book->stock = $request->stock;
        if($request->photo){
            $image = $request->photo;
            list($type, $image) = explode (';', $image);
            list(, $image) = explode(',', $image);
            $data = base64_decode($image);
            $imageName = date("YmdHis"). '.' . 'jpeg';
            file_put_contents(public_path(). '/' . 'images/book/' . $imageName, $data);
            $book->photo = $imageName;

        }
        $book->is_available = 1;
        $book->save();
        return $book;
    }

    public function edit_book (Request $request, $id) {
        $book = Book::findorfail($id);
        $book->book_id = $request->book_id;
        $book->book_name = $request->book_name;
        $book->book_description = $request->book_description;
        $book->stock = $request->stock;
        $book->save();
        return "Update Success";
    }
    public function edit_book_pic (Request $request) {
        $book = Book::findorfail($id);
        $book->book_id = $request->book_id;
        $book->book_name = $request->book_name;
        $book->book_description = $request->book_description;
        $book->stock = $request->stock;
        if($request->photo){
            $image = $request->photo;
            list($type, $image) = explode (';', $image);
            list(, $image) = explode(',', $image);
            $data = base64_decode($image);
            $imageName = date("YmdHis"). '.' . 'jpeg';
            file_put_contents(public_path(). '/' . 'images/book/' . $imageName, $data);
            $book->photo = $imageName;
        }
        $book->save();
        return "Update Success";
    }
    public function delete_book($id){
        $book = Book::find($id)->delete();
        return "Delete Done";
    }
    
}
