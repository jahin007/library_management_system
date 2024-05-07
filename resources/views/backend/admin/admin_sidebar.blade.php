<!-- start: Main Menu -->
<div id="sidebar-left" class="span2">
    <div class="nav-collapse sidebar-nav">
        <ul class="nav nav-tabs nav-stacked main-menu">
            <li><a href="{{route('admin.index')}}"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Category</span></a>
                <ul>
                    <li><a class="submenu" href="{{route('admin.category.create')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Category</span></a></li>
                    <li><a class="submenu" href="{{route('admin.categories')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> All Categories</span></a></li>
                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Author</span></a>
                <ul>
                    <li><a class="submenu" href="{{route('admin.author.create')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Author</span></a></li>
                    <li><a class="submenu" href="{{route('admin.authors')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> All Authors</span></a></li>
                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Book</span></a>
                <ul>
                    <li><a class="submenu" href="{{route('admin.book.create')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Add Book</span></a></li>
                    <li><a class="submenu" href="{{route('admin.books')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> All Books</span></a></li>
                </ul>
            </li>

            <li>
                <a class="dropmenu" href="#"><i class="icon-folder-close-alt"></i><span class="hidden-tablet"> Borrow Book</span></a>
                <ul>
                    <li><a class="submenu" href="{{route('applied_book_list')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Applied Books</span></a></li>
                    <li><a class="submenu" href="{{route('approved_book_list')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Approved Books</span></a></li>
                    <li><a class="submenu" href="{{route('returned_book_list')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Returned Books</span></a></li>
                    <li><a class="submenu" href="{{route('rejected_book_list')}}"><i class="icon-file-alt"></i><span class="hidden-tablet"> Rejected Books</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end: Main Menu -->
