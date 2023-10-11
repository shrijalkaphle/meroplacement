@extends('layout.admin')
@section('title', 'Admin | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Admin </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" data-toggle="modal" data-target="#addAdmin">
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
                                <th>Name</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Since</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th> {{$user->name}} </th>
                                        <td class="text-center">{{ $user->role }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{$user->number}}</td>
                                        <td class="text-center">
                                            <div class="badge badge-info">{{ date('M j, Y',strtotime($user->created_at)) }}</div>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" id="PopoverCustomT-1" onclick="redirectEdit({{ $user->id }})" class="btn btn-primary btn-sm">Edit</button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteAdmin">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="Add Admin" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAdminTitle">Add Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('user.admin.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" required id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" required id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="number">Number</label>
                        <input type="number" name="number" required id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" required id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" required>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>
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
<div class="modal fade" id="deleteAdmin" tabindex="-1" role="dialog" aria-labelledby="Delete Admin" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAdminTitle"><i class="fas fa-info-circle" style="color:red"></i> Confirm Delete</h5>
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
        $('#admin').addClass('mm-active')
        function redirectEdit(id) {
            window.location.href = '/user/admin/'+id+'/edit'
        }
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #user_id').val(id)
            var action = '/user/admin/'+id
            $('#deleteAdmin #deleteForm').attr("action", action)
        })
    </script>
@endsection