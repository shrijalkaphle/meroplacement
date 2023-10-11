@extends('layout.admin')
@section('title', 'Blog | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Blog </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addBlog">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                <strong> <i class="fas fa-check-circle"></i></strong>
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-transform: capitalize">
                <strong> <i class="fas fa-check-circle"></i> </strong>
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 py-3 card ">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th class="text-center">Author</th>
                                <th class="text-center">Posted at</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogs as $blog)
                                    <tr>
                                        <th> {{$blog->title}} </th>
                                        <td class="text-center">{{ $blog->author }}</td>
                                        <td class="text-center">
                                            <div class="badge badge-info">{{ date('M j, Y',strtotime($blog->created_at)) }}</div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" id="PopoverCustomT-1" onclick="redirectEdit({{ $blog->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $blog->id }}" data-toggle="modal" data-target="#deleteBlog">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{$blogs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<div class="modal fade" id="addBlog" tabindex="-1" role="dialog" aria-labelledby="Add Blog" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBlogTitle">Add Blog</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title <span style="color:red">*</span> </label>
                        <input type="text" name="title" required id="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="author">Author <span style="color:red">*</span></label>
                        <input type="text" name="author" required id="author" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags <span style="color:red">*</span></label>
                        <input type="text" name="tags" required id="tags" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cover">Image <span style="color:red">*</span></label>
                        <input type="file" name="cover" id="cover" required onchange="loadImage(event)" class="form-control">
                    </div>
                    <img src="" id="preview" alt="" style="max-height: 150px">
                    <div class="form-group">
                        <label for="content">Content <span style="color:red">*</span></label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteBlog" tabindex="-1" role="dialog" aria-labelledby="Delete Industry" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryTitle"><i class="fas fa-info-circle" style="color:red"></i> Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="deleteForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body delete-body">
                    <input type="hidden" name="blog_id" id="blog_id">
                    <p>Are You Sure Want to Delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        $('#other').addClass('mm-active')
        $('#blog').addClass('mm-active')
        function redirectEdit(id) {
            window.location.href = '/blog/'+id+'/edit'
        }
        var loadImage = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #blog_id').val(id)
            var action = '/blog/'+id
            $('#deleteBlog #deleteForm').attr("action", action)
        })
        ClassicEditor.create( document.querySelector( '#content' )).catch( error => {
            console.error( error );
        } );
    </script>
@endsection