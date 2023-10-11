@extends('layout.admin')
@section('title', 'CV Download Request | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> CV Download Request </div>
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
                                <th>#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Template</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="allResult">
                                @foreach ($cvrequests as $req)
                                    <tr>
                                        <td>#</td>
                                        <td class="text-center">{{ $req->jobseeker->user->name }}</td>
                                        <td class="text-center">{{ $req->template }}</td>
                                        <td class="text-right">
                                            <a href="/cv/preview/{{ $req->jobseeker->user->id }}/{{ $req->template }}" target="_blank" class="btn btn-primary">View</a>
                                            <a href="/cv/deliver/{{ $req->id }}" class="btn btn-success">Send</a>
                                            <a href="/cv/delete/{{ $req->id }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection