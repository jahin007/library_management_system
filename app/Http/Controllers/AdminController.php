<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminController extends Controller
{
    public function index(){
        if (Auth::id()){
            $user_type = Auth()->user()->usertype;
            if ($user_type == 'admin'){
                return view('backend.admin.admin_content');
            }elseif ($user_type == 'user'){
                $borrows = Borrow::where('user_id',Auth::user()->id)->get();
                $categories = Category::all();
                $books = Book::all();
                return view('frontend.content',compact('books','borrows','categories'));
            }
        }else{
            return redirect()->back();
        }
    }

    public function approve_book($id){
        $borrow = Borrow::find($id);
        $status = $borrow->status;

        if($status == 'Approved'){
            session()->flash('approve', 'This book has already approved..!!');
            return redirect()->back();
        }else{
            $borrow->status = 'Approved';
            $borrow->save();

            $book_id = $borrow->book_id;
            $book = Book::find($book_id);
            $book_qty = $book->quantity - '1';
            $book->quantity = $book_qty;
            $book->save();

            session()->flash('approve', 'Book has approved successfully..!!');
            return redirect()->back();
        }
    }

    public function return_book($id){
        $borrow = Borrow::find($id);
        $status = $borrow->status;

        if($status == 'Returned'){
            session()->flash('return', 'This book has already returned..!!');
            return redirect()->back();
        }else{
            $borrow->status = 'Returned';
            $borrow->save();

            $book_id = $borrow->book_id;
            $book = Book::find($book_id);
            $book_qty = $book->quantity + '1';
            $book->quantity = $book_qty;
            $book->save();

            session()->flash('return', 'Book has returned successfully..!!');
            return redirect()->back();
        }
    }

    public function reject_book($id){
        $borrow = Borrow::find($id);
        $borrow->status = 'Rejected';
        $borrow->save();

        session()->flash('reject', 'Book has rejected successfully..!!');
        return redirect()->back();
    }

    public function applied_book_list(){
        $borrows = Borrow::where('status','Applied')->get();
        return view('backend.admin.admin_apply_borrow',compact('borrows'));
    }

    public function approved_book_list(){
        $borrows = Borrow::where('status','Approved')->get();
        return view('backend.admin.admin_approve_borrow',compact('borrows'));
    }

    public function returned_book_list(){
        $borrows = Borrow::where('status','Returned')->get();
        return view('backend.admin.admin_return_borrow',compact('borrows'));
    }

    public function rejected_book_list(){
        $borrows = Borrow::where('status','Rejected')->get();
        return view('backend.admin.admin_reject_borrow',compact('borrows'));
    }
}
