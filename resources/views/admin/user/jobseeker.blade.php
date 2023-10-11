@extends('layout.admin')
@section('title', 'JobSeeker | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> JobSeeker </div>
                </div>
                
                  <div class="page-title-actions">
                    <a type="button" class="btn-shadow mr-3 btn btn-dark" href="{{ route('user.jobseeker.create') }}" style="color:white">
                        <i class="fa fa-plus"></i> Add
                    </a>
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
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone Number</th>
                                <th class="text-center">Prefered Industry</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="allResult">
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <div class="widget-content-left">
                                                            @if($user->jobseeker->photo)
                                                                <img width="80" class="rounded-circle" src="/uploads/{{ $user->jobseeker->photo }}" alt="">
                                                            @else
                                                                <img width="80" class="rounded-circle" src="/uploads/user.png" alt="">
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $user->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                        <td class="text-center"><a href="tel:{{$user->number}}">{{$user->number}}</a></td>
                                        <td class="text-center">
                                            @if($user->jobseeker->preference->industry)
                                                {{$user->jobseeker->preference->industry->title}}
                                            @else
                                                N.A.
                                            @endif
                                        </td>
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
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm delete-modal" data-id="{{ $user->id }}" data-toggle="modal" data-target="#deleteJobSeeker">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tbody id="searchResult"></tbody>
                        </table>
                    </div>
                    <div id="paginate" class="d-block text-center card-footer">
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<div class="modal fade" id="deleteJobSeeker" tabindex="-1" role="dialog" aria-labelledby="Delete JobSeeker" aria-modal="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteJobSeekerTitle"><i class="fas fa-info-circle" style="color:red"></i> Confirm Delete</h5>
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
        $('#jobseeker').addClass('mm-active')
        function redirectEdit(id) {
            window.location.href = '/user/jobseeker/'+id+'/edit'
        }
        $(document).on("click", ".delete-modal", function() {
            var id = $(this).data('id')
            $('.delete-body #user_id').val(id)
            var action = '/user/jobseeker/'+id
            $('#deleteJobSeeker #deleteForm').attr("action", action)
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
                    url: '/search-jobseeker/'+query,
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
                        industry = ''
                        $.each(res.data, function(index,user) {
                            html = html + '<tr><td>' + user.name + '</td><td class="text-center"><a href="mailto:' + user.email + '">' + user.email + '</a></td><td class="text-center"><a href="tel:' + user.number + '">' + user.number + '</a></td>'
                            if(user.jobseeker.preference.industry) {
                                industry = user.jobseeker.preference.industry.title
                            } else {
                                industry = 'N.A.'
                            }
                            html = html + '<td class="text-center">' + industry + '</td><td class="text-center">'
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
                $('#paginate').removeClass('hidden')
                $('#searchResult').addClass('hidden')
                $('#loader').addClass('hidden')
            }
        }
    </script>
@endsection