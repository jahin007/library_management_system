<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use File;

class AuthorController extends Controller
{
    public function manage_author(){
        $authors = Author::all();
        return view('backend.author.manage_author',compact('authors'));
    }

    public function author_create(){
        return view('backend.author.author_create');
    }

    public function author_store(Request $request){
        $request->validate([
            'name' => 'required|max:150',
            'description' => 'required',
        ]);

        $author = new Author();
        $author->id = $request->author;
        $author->name = $request->name;
        $author->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img = time().'.' . $image->getClientOriginalExtension();
            $location = public_path('images/authors/');
            $image->move($location, $img);

            $author->image = $img;
        }
        $author->save();

        session()->flash('success', 'Author has created successfully..!!');
        return redirect()->route('admin.authors');
    }


    public function author_edit($id){
        $author = Author::find($id);
        return view('backend.author.author_edit',compact('author'));
    }

    public function author_update(Request $request,$id){
        $author = Author::find($id);
        $author->name = $request->name;
        $author->description = $request->description;

        if ($request->hasFile('image')) {

            if(File::exists('images/authors/'.$author->image)){
                File::delete('images/authors/'.$author->image);
            }

            $image = $request->file('image');
            $img = time().'.' . $image->getClientOriginalExtension();
            $location = public_path('images/authors/');
            $image->move($location, $img);

            $author->image = $img;
        }
        $author->save();

        session()->flash('success', 'Author has updated successfully..!!');
        return redirect()->route('admin.authors');

    }

    public function author_delete($id){
        $author = Author::find($id);
        if (!is_null($author)) {
            if (File::exists('images/authors/' . $author->image)) {
                File::delete('images/authors/' . $author->image);
            }
            $author->delete();
        }
        session()->flash('delete', 'Author has deleted successfully..!!');
        return back();
    }
}
