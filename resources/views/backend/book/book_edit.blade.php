@extends('backend.admin.admin_master')
@section('content')
    @include('backend.admin.admin_message')
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header" data-original-title>
                <h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Book</h2>
            </div>
            <div class="box-content">
                <form class="form-horizontal" action="{{route('admin.book.update',$book->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="date01">Book Name</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="title" value="{{$book->title}}" required>
                            </div>
                        </div>

                        <div class="control-group hidden-phone">
                            <label class="control-label" for="textarea2">Description</label>
                            <div class="controls">
                                <textarea class="cleditor" name="description" rows="3" required>{!!$book->description!!}</textarea>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">Price</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="price" value="{{$book->price}}" required>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="date01">quantity</label>
                            <div class="controls">
                                <input type="text" class="input-xlarge" name="quantity" value="{{$book->quantity}}" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Select Category</label>
                            <div class="controls">
                                <select name="category">
                                    <option value="" disabled selected>Open this category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$category->id==$book->cat_id ? 'selected':''}}>{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Select Author</label>
                            <div class="controls">
                                <select name="author">
                                    <option value="" disabled selected>Open this author</option>
                                    @foreach($authors as $author)
                                        <option value="{{$author->id}}" {{$author->id==$book->aut_id ? 'selected':''}}>{{$author->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">File Upload</label>
                            <div class="controls">
                                <input type="file" name="book_image[]" class="form-control" id="book_image" multiple>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Edit Book</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div><!--/span-->
    </div><!--/row-->
@endsection

