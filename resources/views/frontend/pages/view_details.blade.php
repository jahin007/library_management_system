@extends('frontend.master')
@section('content')
    <div class="item-details-page">
        <div class="container">
            <div class="row">
                @include('frontend.message')
                <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>View Details <em>For Item</em> Here.</h2>
                    </div>
                </div>
                <div class="col-lg-7">
                    @php
                        $i = 1;
                    @endphp
                    @foreach($book->images as $image)
                        @if($i > 0)
                        <div class="left-image">
                            <img src="{{asset('/images/books/'.$image->image)}}" alt="" style="border-radius: 20px; width: 600px; height: 450px;">
                        </div>
                        @endif
                        @php
                            $i--;
                        @endphp
                    @endforeach
                </div>
                <p class="col-lg-5 align-self-center">
                    <h2 class="mb-5 mt-5">{{$book->title}}</h2>
                    <span class="author">
                        <img src="{{asset('/images/authors/'.$book->author->image)}}" alt="" style="width: 150px; height: 100px; border-radius: 50%;">

                    </span>
                    <p> <h6>Author Name : {{$book->author->name}}</h6></p>
                    <p>{!! $book->description !!}</p>
                    <div class="row">
                        <div class="col-3">
                            <span class="bid">
                            Available<br><strong>{{$book->quantity}}</strong><br>
                            </span>
                        </div>

                        <div class="col-5 mb-5">
                            <span class="ends">
                            Total Quantity<br><strong>20</strong><br>
                            </span>
                        </div>
                    </div>
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
    </div>
@endsection
