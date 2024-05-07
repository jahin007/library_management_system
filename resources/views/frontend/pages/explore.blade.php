@extends('frontend.master')
@section('content')
    <div class="discover-items">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form id="search-form"  method="get" action="{{route('search')}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-10">
                                <fieldset>
                                    <input type="search" name="search" class="searchText" placeholder="Type Something..." autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-2">
                                <fieldset>
                                    <button class="main-button" type="submit">Search</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="currently-market">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="section-heading">
                                    <div class="line-dec"></div>
                                    <h2>Browse Through Book <em>Categories</em> Here.</h2>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="filters">
                                    <ul>
                                        @foreach($categories as $category)
                                            @php
                                                $path = 'book_by_cat/'.$category->id;
                                            @endphp
                                            <li class="{{ Request::path() ==  $path ? 'active' : ''  }}"><a href="{{route('book_by_cat',$category->id)}}">{{$category->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @include('frontend.message')
                            <div class="col-lg-12">
                                <div class="row grid">

                                    @foreach($books as $book)
                                    <div class="col-lg-6 currently-market-item all msc">
                                        <div class="item">
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach($book->images as $image)
                                                @if($i > 0)
                                                    <div class="left-image">
                                                        <img src="{{asset('/images/books/'.$image->image)}}" alt="" style="border-radius: 20px; width: 230px; height:150px; margin-top: 05px;">
                                                    </div>
                                                @endif
                                                @php
                                                    $i--;
                                                @endphp
                                            @endforeach
                                            <div class="right-content">
                                                <h1 class="mb-5">{{$book->title}}</h1>
                                                <span>
                                                    <img src="{{asset('/images/authors/'.$book->author->image)}}" alt="" style="max-width: 100px; border-radius: 50%; ;">
                                                </span>
                                                <p class="mt-3">Author Name : {{$book->author->name}}</p>
                                                <p>Category : {{$book->category->name}}</p>
                                                <div class="line-dec"></div>
                                                <span class="bid">
                                                    Current Available<br><strong>{{$book->quantity}}</strong><br>
                                                </span>
                                                <div class="text-button">
                                                    <a href="{{route('view_details',$book->id)}}">View Item Details</a>
                                                </div>
                                                <br>
                                                <div>
                                                    @php
                                                        $book_found = false;
                                                    @endphp
                                                    @foreach($borrows as $borrow)
                                                        @if($borrow->book->id == $book->id)
                                                            @php
                                                                $book_found = true;
                                                            @endphp
                                                            @break
                                                        @endif
                                                    @endforeach
                                                    @if($book_found == true)
                                                        <p>This book is already applied..</p>
                                                    @else
                                                        <a class="btn btn-outline-primary" href="{{route('borrow_book',$book->id)}}">Apply to borrow book</a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
