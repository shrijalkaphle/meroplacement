@extends('layout.admin')
@section('title', 'Employee | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Employee </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addEmployee">
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
                <div class="text-right" style="height: 40px">
                    <input type="search" name="search" id="search" class="form-control" style="width:25%;float:right" placeholder="Search" oninput="search(this.value)">
                </div>
                <br>
                <div class="main-card mb-3 py-3 card ">
                    <div class="table-responsive">
                        <form action='/deleteAllEmployee' method='POST'>
                        @csrf
                        <input type='submit' class='btn btn-primary' value='Delete All Selected'>
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                 <th>CheckBox</th>
                                <th>Company Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone Number</th>
                           
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody id="allResult">
                                @foreach ($users as $user)
                                    <tr>
                                        <td><input type="checkbox" name="ids[{{$user->id}}]" value='{{$user->id}}'></td>
                                        <th> {{ $user->name }} </th>
                                        <td class="text-center"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                        <td class="text-center"><a href="tel:{{$user->number}}">{{$user->number}}</a></td>
                              
                                        <td class="text-center">
                                            @if($user->email_verified)
                                                <div class="badge badge-info">Verified</div>
                                            @else
                                                <div class="badge badge-danger">Not Verified</div>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(!$user->email_verified)
                                            <a type="button" id="PopoverCustomT-1" href="{{ route('user.activate',$user->id) }}" class="btn btn-info btn-sm">Activate</a>
                                            @endif
                                            <button type="button" id="PopoverCustomT-1" onclick="redirectEdit({{ $user->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteEmployee">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody id="searchResult"></tbody>
                        </table>
                        </form>
                    </div>
                    <div class="d-block text-center card-footer" id="paginate">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<div class="modal fade" id="addEmployee" tabindex="-1" role="dialog" aria-labelledby="Add Employee" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeTitle">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('user.employee.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" required id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="number">Number</label>
                        <input type="number" name="number" required id="" class="form-control">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" name="email" required id="" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" required id="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="industry">Industry</label>
                            <select name="industry_id" id="industry_id" class="form-control">
                                @foreach ($industries as $i)
                                    <option value="{{ $i->id }}">{{ $i->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="address">Address</label>
                            <input type="text" name="address" required id="" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <label for="logo">Logo</label>
                            <input type="file" name="logo" id="" onchange="LoadImage(event)" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <img src="" alt="" id="preview" style="max-height:150px">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10"  class="form-control" required></textarea>
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
<div class="modal fade" id="deleteEmployee" tabindex="-1" role="dialog" aria-labelledby="Delete Employee" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEmployeeTitle"><i class="fas fa-info-circle" style="color:red"></i> Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="deleteForm" method="post">
                @csrf
                @method('DELETE')
                <div class="modal-body delete-body">
                    <input type="hidden" name="user_id" id="user_id">
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
        $('#user').addClass('mm-active')
        $('#employee').addClass('mm-active')
        function redirectEdit(id) {
            window.location.href = '/user/employee/'+id+'/edit'
        }
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #user_id').val(id)
            var action = '/user/employee/'+id
            $('#deleteEmployee #deleteForm').attr("action", action)
        })
        var LoadImage = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        function search(query) {
            if (query.length > 2) {
                $('#loader').removeClass('hidden')
                $.ajax({
                    method: 'GET',
                    url: '/search-employee/'+query,
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
                            html = html + '<td class="text-center">' + user.company.industry.title + '</td><td class="text-center">'
                            if(user.email_verified == 1) {
                                html = html + '<div class="badge badge-info">Verified</div></td><td class="text-center">'
                            } else {
                                html = html + '<div class="badge badge-danger">Not Verified</div></td><td class="text-center">'
                            }
                            html = html + '<button type="button" id="PopoverCustomT-1" onclick="redirectEdit(' + user.id + ')" class="btn btn-primary btn-sm">Edit</button>'
                            html = html + '<button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="' + user.id + '" data-toggle="modal" data-target="#deleteEmployee">Delete</button>'
                            html = html + '</td></tr>'
                        })
                        $('#searchResult').html(html)
                    },
                })
            }else {
                $('#allResult').removeClass('hidden')
                $('#searchResult').addClass('hidden')
                $('#loader').addClass('hidden')
            }
        }
    </script>
@endsection