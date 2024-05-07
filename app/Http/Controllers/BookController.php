<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\Category;
use Illuminate\Http\Request;
use File;

class BookController extends Controller
{
    public function manage_book(){
        $books = Book::all();
//        foreach ($books as $book) {
//            $book_images = BookImage::where('book_id', $book->id)->get();
//            $book->images = $book_images;
//        }
        return view('backend.book.manage_book',compact('books'));
    }

    public function book_create(){
        $categories = Category::all();
        $authors = Author::all();
        return view('backend.book.book_create',compact('categories','authors'));
    }

    public function book_store(Request $request){
        $request->validate([
            'title' => 'required|max:150',
            'description' => 'required',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->cat_id = $request->category;
        $book->aut_id = $request->author;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
        $book->save();

        if ($request->hasFile('book_image')) {
            $images = $request->file('book_image');
            $i = 0;
            foreach ($images as $image) {
                $img = time() . ++$i . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/books/');
                $image->move($location, $img);

                $book_image = new BookImage();
                $book_image->book_id = $book->id;
                $book_image->image = $img;
                $book_image->save();
            }
        }

        session()->flash('success','Book has created successfully..!!');
        return redirect()->route('admin.books');
    }

    public function book_status_change($id){
        $book = Book::find($id);
        if($book->status ==1){
            $book->update(['status'=>0]);
        }else{
            $book->update(['status'=>1]);
        }
        session()->flash('success', 'Book status has changed successfully..!!');
        return redirect()->route('admin.books');
    }

    public function book_edit($id){
        $book = Book::find($id);
        $categories = Category::all();
        $authors = Author::all();
        return view('backend.book.book_edit',compact('book','categories','authors'));
    }

    public function book_update(Request $request,$id){

        $book = Book::find($id);
        $book->cat_id = $request->category;
        $book->aut_id = $request->author;
        $book->title = $request->title;
        $book->description = $request->description;
        $book->price = $request->price;
        $book->save();

        $book_images = BookImage::where('book_id',$book->id)->get();
        foreach ($book_images as $image){
            if(File::exists('images/books/'.$image->image)){
                File::delete('images/books/'.$image->image);
            }
            $image->delete();
        }

        if ($request->hasFile('book_image')) {
            $images = $request->file('book_image');
            $i = 0;
            foreach ($images as $image) {
                $img = time() . ++$i . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/books/');
                $image->move($location, $img);

                $book_image = new BookImage();
                $book_image->book_id = $book->id;
                $book_image->image = $img;
                $book_image->save();
            }
        }

        session()->flash('update','Book has updated successfully..!!');
        return redirect()->route('admin.books');
    }

    public function book_delete($id){
        $book = Book::find($id);
        $book_images = BookImage::where('book_id',$book->id)->get();
        foreach ($book_images as $image){
            if(File::exists('images/books/'.$image->image)){
                File::delete('images/books/'.$image->image);
            }
            $image->delete();
        }
        if(!is_null($book)){
            $book->delete();
        }
        session()->flash('delete','Book has deleted successfully..!!');
        return back();
    }
}
