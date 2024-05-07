@extends('frontend.master')
@section('content')
    <div class="item-details-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <div class="line-dec"></div>
                        <h2>Book History <em>For Item</em> Here.</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                        <thead>
                        <tr style="background-color: #6610f2;">
                            <th style="width: 30%; color: #FFFFFF;">Book Name</th>
                            <th style="width: 30%; color: #FFFFFF;">Author Name</th>
                            <th style="width: 10%; color: #FFFFFF;">Book Status</th>
                            <th style="width: 20%; color: #FFFFFF;">Image</th>
                            <th style="width: 10%; color: #FFFFFF;">Cancel Request </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($borrow as $borrow)
                            <tr>
                            <td class="center" style="color: #FFFFFF;">{{$borrow->book->title}}</td>
                            <td class="center" style="color: #FFFFFF;">{{$borrow->book->author->name}}</td>
                            <td class="center">
                                @if($borrow->status == 'Approved')
                                    <span style="color: green;"><b>{{$borrow->status}}</b></span>
                                @endif
                                @if($borrow->status == 'Returned')
                                    <span style="color: dodgerblue;"><b>{{$borrow->status}}</b></span>
                                @endif
                                @if($borrow->status == 'Rejected')
                                    <span style="color: red;"><b>{{$borrow->status}}</b></span>
                                @endif
                                @if($borrow->status == 'Applied')
                                    <span style="color: white;"><b>{{$borrow->status}}</b></span>
                                @endif</td>
                            <td>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($borrow->book->images as $image)
                                    @if($i > 0)
                                    <img src="{{asset('/images/books/'.$image->image)}}" alt="" style="height: 80px; width: 100px;">
                                    @endif
                                    @php
                                        $i--;
                                    @endphp
                                @endforeach
                            </td>
                            <td>
                                @if($borrow->status == 'Applied')
                                    <a class="btn btn-warning" href="{{route('cancel_request',$borrow->id)}}">Cancel</a>
                                @else
                                    <p>Not Allowed</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
