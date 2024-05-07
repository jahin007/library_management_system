@extends('backend.admin.admin_master')
@section('content')
    @include('backend.admin.admin_message')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>Approved Books</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th style="width: 10%">User Name</th>
                        <th style="width: 10%">Email</th>
                        <th style="width: 05%">Phone</th>
                        <th style="width: 10%">Book Name</th>
                        <th style="width: 05%">Quantity</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 20%">Book Image</th>
                        <th style="width: 30%">Change Status</th>
                    </tr>
                    </thead>
                    @foreach($borrows as $borrow)
                        <tbody>
                        <tr>
                            <td class="center">{{$borrow->user->name}}</td>
                            <td class="center">{{$borrow->user->email}}</td>
                            <td class="center">{{$borrow->user->phone}}</td>
                            <td class="center">{{$borrow->book->title}}</td>
                            <td class="center">{{$borrow->book->quantity}}</td>
                            <td class="center" style="color: green;"><b>{{$borrow->status}}</b></td>
                            <td>
                                @foreach($borrow->book->images as $image)
                                    <img src="{{asset('/images/books/'.$image->image)}}" alt="" style="height: 50px; width: 50px;">
                                @endforeach
                            </td>
                            <td>
                                @if($borrow->status == 'Approved')
                                    <a class="btn btn-info" href="{{route('return_book',$borrow->id)}}">Return</a>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection

