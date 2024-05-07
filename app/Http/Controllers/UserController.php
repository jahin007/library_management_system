<?php

namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserController extends Controller
{
    public function index(){

        $categories = Category::where('status',1)->get();
        $books = Book::all();
        $popular_borrowed_books = DB::table('books')
            ->leftJoin('borrows', 'books.id', '=', 'borrows.book_id')
            ->select('books.id', DB::raw('count(*) as total'))
            ->groupBy('books.id')
            ->orderBy('total', 'desc')
            ->take(2)
            ->get();

        $popular_books=[];
        foreach ($popular_borrowed_books as $popular_borrowed_book) {
            $book = Book::findOrFail($popular_borrowed_book->id);
            $book->total_borrow = $popular_borrowed_book->total;
            $popular_books[] = $book;
        }

        if (Auth::id()){
            $user_type = Auth()->user()->usertype;
           if ($user_type == 'user'){
                $borrows = Borrow::where('user_id',Auth::user()->id)->get();
           }
           else {
               $borrows= [];
           }
        }
        else{
            $borrows= [];
        }

        return view('frontend.content',compact('books','categories', 'borrows', 'popular_books'));
    }

    public function view_details($id){
        $borrows = Borrow::all();
        $categories = Category::where('status',1)->get();
        $book = Book::find($id);
        return view('frontend.pages.view_details',compact('book','categories','borrows'));
    }

    public function explore()
    {
        if (Auth::id()) {
            $user_type = Auth()->user()->usertype;
            if ($user_type == 'user') {
                $borrows = Borrow::where('user_id', Auth::user()->id)->get();
                $categories = Category::where('status', 1)->get();
                $authors = Author::all();
                $books = Book::all();

                return view('frontend.pages.explore', compact('books', 'categories', 'authors', 'borrows'));
            }
        } else {
            $borrows = [];
            $categories = Category::where('status', 1)->get();
            $authors = Author::all();
            $books = Book::all();
            return view('frontend.pages.explore', compact('books', 'categories', 'authors', 'borrows'));
        }
    }


    public function search(Request $request){
        $categories = Category::all();
        $authors = Author::all();
        $search = $request->search;
        $books = Book::with('author')
            ->whereHas('category', function($q) use ($search){
                $q->where('name', 'LIKE', '%'.$search.'%' );
            })
            ->orWhereHas('author', function($q) use ($search){
                $q->where('name', 'LIKE', '%'.$search.'%' );
            })
            ->orWhere('title','like','%'.$search.'%')
            ->get();

        return view('frontend.pages.explore',compact('books','authors','categories'));
    }

    public function book_by_cat($id){
        $borrows = Borrow::all();
        $categories = Category::where('status',1)->get();
        $books = Book::where('status',1)->where('cat_id',$id)->get();
        return view('frontend.pages.explore',compact('books','categories','borrows'));
    }

    public function borrow_book($id){
        $book = Book::find($id);
        $book_id = $id;
        $quantity = $book->quantity;
        if ($quantity >= '1'){
            if (Auth::id()){
                $user_id = Auth::user()->id;
                $borrows = new Borrow();
                $borrows->book_id = $book_id;
                $borrows->user_id = $user_id;
                $borrows->save();

                session()->flash('success', 'A request is send to admin to borrow this book ..');
                return redirect()->back();
            }else{
                return redirect()->route('logout');
            }
        }else{
            session()->flash('delete', 'Not enough book available..!!');
            return redirect()->back();
        }
    }

    public function book_history(){
        if (Auth::id()){
            $user_id = Auth::user()->id;
            $borrow = Borrow::where('user_id',$user_id)->get();

            return view('frontend.pages.book_history',compact('borrow'));
        }
    }

    public function cancel_request($id){
        $borrow = Borrow::find($id);
        $borrow->delete();

        session()->flash('delete', 'Book request cancel successfully..!!');
        return redirect()->back();
    }

}
