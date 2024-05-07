@extends('backend.admin.admin_master')
@section('content')
    @include('backend.admin.admin_message')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon user"></i><span class="break"></span>All Authors</h2>
                <div class="box-icon">
                    <a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                    <tr>
                        <th style="width: 05%">ID</th>
                        <th style="width: 15%">Author Name</th>
                        <th style="width: 30%">Description</th>
                        <th style="width: 15%">Image</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                    </thead>
                    @foreach($authors as $author)
                    <tbody>
                    <tr>
                        <td>{{$author->id}}</td>
                        <td class="center">{{$author->name}}</td>
                        <td class="center">{!!$author->description!!}</td>
                        <td>
                            <img src="{{asset('/images/authors/'.$author->image)}}" alt="" style="width: 150px; height: 80px;">
                        </td>
                        <td class="center">
                            <div class="span3"></div>
                            <div class="span6">
                                <a class="btn btn-info" href="{{route('admin.author.edit',$author->id)}}">
                                    <i class="halflings-icon white edit"></i>
                                </a>
                                <a class="btn btn-danger" href="{{route('admin.author.delete',$author->id)}}">
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
