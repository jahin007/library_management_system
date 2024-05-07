@extends('frontend.master')
@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="header-text">
                        <h6>Book is Knowledge</h6>
                        <h2>Knowledge is Power</h2>
                        <p>Library is a really cool and professional design for your websites. This HTML CSS template is based on Bootstrap v5 and it is designed for related web portals. Liberty can be freely downloaded from github</p>
                        <div class="buttons">
                            <div class="border-button">
                                <a href="{{route('explore')}}">Explore Top Books</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="">
                        <div class="item">
                            <img src="assets/images/banner.png" alt="">
                        </div>
                        <div class="item">
                            <img src="assets/images/banner2.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Main Category Area Start ***** -->
    <div class="categories-collections">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="categories">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-heading">
                                    <div class="line-dec"></div>
                                    <h2>All Books <em>Category</em> Here.</h2>
                                </div>
                            </div>
                            @foreach($categories as $category)
                            <div class="col-lg-2 col-sm-6">
                                <div class="item">
                                    <div class="icon">
                                        <img src="{{asset('/images/categories/'.$category->image)}}" alt="">
                                    </div>
                                    <h4>{{$category->name}}</h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- ***** Main Category Area End ***** -->

    <div class="currently-market">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Browse All <em>Books</em> Here.</h2>
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
                                        <img src="{{asset('/images/books/'.$image->image)}}" alt="" style="border-radius: 20px; width: 230px; height:150px;">
                                    </div>
                                    @endif
                                @php
                                    $i--;
                                @endphp
                                @endforeach
                                <div class="right-content">
                                    <h1 class="mb-3">{{$book->title}}</h1>
                                    <span>
                                        <img src="{{asset('/images/authors/'.$book->author->image)}}" alt="" style="max-width: 100px; border-radius: 50%;">
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
                                                    $status = $borrow->status;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @if($book_found == true && $status == 'Applied')
                                            <p>This book is already applied..</p>
                                        @elseif($book_found == true && $status == 'Approved')
                                            <p style="color: green;">Admin already approved this book..</p>
                                        @elseif($book_found == true && $status == 'Rejected')
                                            <p style="color: red;">Admin rejected this book..</p>
                                        @elseif($book_found == true && $status == 'Returned')
                                            <p style="color: dodgerblue;">Return book successfully..</p>
                                            <a class="btn btn-outline-primary" href="{{route('borrow_book',$book->id)}}">Apply to borrow book again</a>
                                        @elseif($book_found == false)
                                            <a class="btn btn-outline-primary" href="{{route('borrow_book',$book->id)}}">Apply to borrow book </a>
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

    <!-- ***** Popular Books Area End ***** -->

    <div class="currently-market">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Browse All <em>Popular Books</em> Here.</h2>
                    </div>
                </div>
                @include('frontend.message')
                <div class="col-lg-12">
                    <div class="row grid">
                        @foreach($popular_books as $popular_book)
                            <div class="col-lg-6 currently-market-item all msc">
                                <div class="item">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach($popular_book->images as $image)
                                        @if($i > 0)
                                            <div class="left-image">
                                                <img src="{{asset('/images/books/'.$image->image)}}" alt="" style="border-radius: 20px; width: 230px; height:150px;">
                                            </div>
                                        @endif
                                        @php
                                            $i--;
                                        @endphp
                                    @endforeach
                                    <div class="right-content">
                                        <h1 class="mb-3">{{$popular_book->title}}</h1>
                                        <span>
                                            <img src="{{asset('/images/authors/'.$popular_book->author->image)}}" alt="" style="max-width: 100px; border-radius: 50%;">
                                        </span>
                                            <p class="mt-3">Author Name : {{$popular_book->author->name}}</p>
                                            <p>Category : {{$popular_book->category->name}}</p>
                                        <div class="line-dec"></div>
                                        <span class="bid">
                                        Total Borrowed<br><strong>{{$popular_book->total_borrow}}</strong><br>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


