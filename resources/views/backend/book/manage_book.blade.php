@extends('backend.admin.admin_master')
@section('content')
    @include('backend.admin.admin_message')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Books</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th style="width: 10%">Book Name</th>
                        <th style="width: 15%">Description</th>
                        <th style="width: 05%">Price</th>
                        <th style="width: 20%">Image</th>
                        <th style="width: 10%">Cat Name</th>
                        <th style="width: 10%">Author Name</th>
                        <th style="width: 10%">Author Image</th>
                        <th style="width: 05%">Status</th>
                        <th style="width: 15%">Actions</th>
                    </tr>
                    </thead>
                    @foreach($books as $book)
                    <tbody>
                    <tr>
                        <td class="center">{{$book->title}}</td>
                        <td class="center">{!!$book->description!!}</td>
                        <td class="center">&#2547;{{$book->price}}</td>
                        <td>
                            @foreach($book->images as $image)
                                <img src="{{asset('/images/books/'.$image->image)}}" alt="" style="height: 50px; width: 50px;">
                            @endforeach
                        </td>
                        <td class="center">{{$book->category->name}}</td>
                        <td class="center">{{$book->author->name}}</td>
                        <td>
                            <img src="{{asset('/images/authors/'.$book->author->image)}}" alt="" style="width: 100px; height: 50px;">
                        </td>
                        <td class="center">
                            @if($book->status == 1)
                                <span class="label label-success">Active</span>
                            @else
                                <span class="label label-danger">Deactive</span>
                            @endif
                        </td>
                        <td class="center">
                            <div class="span3"></div>
                            <div class="span2">
                                @if($book->status == 1)
                                <a class="btn btn-danger" href="{{route('admin.book.status',$book->id)}}">
                                    <i class="halflings-icon white thumbs_down"></i>
                                </a>
                                @else
                                    <a class="btn btn-success" href="{{route('admin.book.status',$book->id)}}">
                                        <i class="halflings-icon white thumbs_up"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="span2">
                                <a class="btn btn-info" href="{{route('admin.book.edit',$book->id)}}">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                            </div>
                            <div class="span2">
                                <a class="btn btn-danger" href="{{route('admin.book.delete',$book->id)}}">
                                    <i class="halflings-icon white trash"></i>
                                </a>
                            </div>
                            <div class="span3"></div>
                        </td>
                    </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div><!--/span-->

    </div><!--/row-->
@endsection
