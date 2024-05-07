<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use File;

class CategoryController extends Controller
{
    public function manage_category(){
        $categories = Category::all();
        return view('backend.category.manage_category',compact('categories'));
    }

    public function category_create(){
        return view('backend.category.category_create');
    }

    public function category_store(Request $request){
        $request->validate([
            'name' => 'required|max:150',
            'description' => 'required',
        ]);

        $category = new Category();
        $category->id = $request->category;
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img = time().'.' . $image->getClientOriginalExtension();
            $location = public_path('images/categories/');
            $image->move($location, $img);

            $category->image = $img;
        }
        $category->save();

        session()->flash('success', 'Category has created successfully..!!');
        return redirect()->route('admin.categories');
    }

    public function cat_status_change($id){
        $category = Category::find($id);
        if($category->status ==1){
            $category->update(['status'=>0]);
        }else{
            $category->update(['status'=>1]);
        }
        session()->flash('success', 'Category status has changed successfully..!!');
        return redirect()->route('admin.categories');
    }

    public function category_edit($id){
        $category = Category::find($id);
        return view('backend.category.category_edit',compact('category'));
    }

    public function category_update(Request $request,$id){
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {

            if(File::exists('images/categories/'.$category->image)){
                File::delete('images/categories/'.$category->image);
            }

            $image = $request->file('image');
            $img = time().'.' . $image->getClientOriginalExtension();
            $location = public_path('images/categories/');
            $image->move($location, $img);

            $category->image = $img;
        }
        $category->save();

        session()->flash('success', 'Category has updated successfully..!!');
        return redirect()->route('admin.categories');

    }

    public function category_delete($id){
        $category = Category::find($id);
        if (!is_null($category)) {
            if (File::exists('images/categories/' . $category->image)) {
                File::delete('images/categories/' . $category->image);
            }
            $category->delete();
        }
        session()->flash('delete', 'Category has deleted successfully..!!');
        return back();
    }
}

