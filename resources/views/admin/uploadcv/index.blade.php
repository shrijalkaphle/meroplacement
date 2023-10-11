@extends('layout.admin')
@section('title', 'Uploaded CV | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Uploaded CV </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addUploadCV">
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
                <strong> <i class="fas fa-times-circle"></i> </strong>
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <div class="text-right" style="height: 40px">
                    <input type="search" name="search" id="search" class="form-control" style="width:25%;float:right" placeholder="Search" oninput="search(this.value)">
                </div>
                <br>
                <div class="main-card mb-3 py-3 card ">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Education</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="allResult">
                                @foreach ($uploads as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-center"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                        <td class="text-center"><a href="tel:{{$user->number}}">{{$user->number}}</a></td>
                                        <td class="text-center">{{ $user->address }}</td>
                                        <td class="text-center">{{ $user->education }}</td>
                                        <td class="text-center">
                                            <a type="button" id="PopoverCustomT-1" href="/uploads/{{$user->cv}}" target='_blank' class="btn btn-info btn-sm">View</a>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm edit-modal" data-all="{{ $user }}" data-toggle="modal" data-target="#editUploadedCV">Edit</button>
                                            @if (Session::get('user')['role'] == 'admin')
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteUploadedCV">Delete</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody id="searchResult"></tbody>
                        </table>
                    </div>
                    <div id="paginate" class="d-block text-center card-footer">
                        {{$uploads->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<div class="modal fade" id="addUploadCV" tabindex="-1" role="dialog" aria-labelledby="Add Qualification" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQualificationTitle">Upload CV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('uploadcv.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" name="name" required id="name" class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="email">Email*</label>
                            <input type="email" name="email" required id="email" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="number">Number*</label>
                            <input type="number" name="number" required id="number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address*</label>
                        <input type="text" name="address" required id="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="education">Education*</label>
                        <input type="text" name="education" required id="education" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cv">CV/Resume*</label>
                        <input type="file" name="cv" required id="cv" class="form-control">
                        <span>*File other than pdf not accepted</span>
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

<div class="modal fade" id="editUploadedCV" tabindex="-1" role="dialog" aria-labelledby="Add Qualification" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUploadedCVTitle">Edit Upload CV</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="updateForm" method="post" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="modal-body edit-body">
                    <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" name="name" required id="name" class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="email">Email*</label>
                            <input type="email" name="email" required id="email" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="number">Number*</label>
                            <input type="number" name="number" required id="number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address*</label>
                        <input type="text" name="address" required id="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="education">Education*</label>
                        <input type="text" name="education" required id="education" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="cv">CV/Resume</label>
                        <input type="file" name="cv" id="cv" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteUploadedCV" tabindex="-1" role="dialog" aria-labelledby="Delete JobSeeker" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUploadedCVTitle"><i class="fas fa-info-circle" style="color:red"></i> Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="deleteForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body delete-body">
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
        $('#uploadcv').addClass('mm-active')

        $(document).on("click", ".edit-modal", function() {
            var all = $(this).data('all')
            $('.edit-body #name').val(all.name)
            $('.edit-body #email').val(all.email)
            $('.edit-body #number').val(all.number)
            $('.edit-body #education').val(all.education)
            $('.edit-body #address').val(all.address)

            var action = 'uploadcv/'+all.id
            $('#editUploadedCV #updateForm').attr("action", action)
        })
        
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            var action = 'uploadcv/'+id
            $('#deleteUploadedCV #deleteForm').attr("action", action)
        })
        function search(query) {
            if (query.length > 2) {
                $('#loader').removeClass('hidden')
                $.ajax({
                    method: 'GET',
                    url: '/search-file/'+query,
                    data: {query: query},
                    dataType: "json",
                    beforeSend:function(){
                        $('#allResult').addClass('hidden')
                        $('#paginate').addClass('hidden')
                        $('#searchResult').removeClass('hidden')
                    },
                    success: function(res) {
                        console.log(res)
                        $('#loader').addClass('hidden')
                        html = ''
                        $.each(res.data, function(index,user) {
                            html = html + '<tr><td>' + user.name + '</td><td class="text-center"><a href="mailto:' + user.email + '">' + user.email + '</a></td><td class="text-center"><a href="tel:' + user.number + '">' + user.number + '</a></td>'
                            html = html + '<td class="text-center">' + user.address + '</td><td class="text-center">' + user.education + '</td><td class="text-center">'
                            html = html + '<a type="button" id="PopoverCustomT-1" href="/uploads/' + user.cv + '" class="btn btn-info btn-sm" download>Download</a>'
                            html = html + ' <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm edit-modal" data-all="'+ user + '" data-toggle="modal" data-target="#editUploadedCV">Edit</button>'
                            html = html + ' <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="' + user.id + '" data-toggle="modal" data-target="#deleteEmployee">Delete</button>'
                            html = html + '</td></tr>'
                        })
                        $('#searchResult').html(html)
                    },
                })
            }else {
                $('#allResult').removeClass('hidden')
                $('#paginate').removeClass('hidden')
                $('#searchResult').addClass('hidden')
                $('#loader').addClass('hidden')
            }
        }
        
    </script>
@endsection