@extends('layout.admin')
@section('title',  $user->name . ' | Edit | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Edit Employee </div>
                </div>
            </div>
        </div>
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
                <div class="main-card mb-3 card card-body">
                    <form method="POST" action="{{ route('user.employee.update', $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" required id="" value="{{ $user->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="number">Number</label>
                            <input type="number" name="number" required id="" value="{{ $user->number }}" class="form-control">
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="email" name="email" required id="" value="{{ $user->email }}" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="industry">Industry</label>
                                <select name="industry_id" id="industry_id" class="form-control">
                                    @foreach ($industries as $i)
                                        <option value="{{ $i->id }}" @if($i->id == $user->company->industry_id) selected @endif>{{ $i->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="website">Website</label>
                                <input type="text" name="website" value="{{ $user->company->website }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="address">Address</label>
                                <input type="text" name="address" required value="{{ $user->company->address }}" class="form-control">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" id="" onchange="LoadImage(event)" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <img src="@if($user->company->logo) /uploads/{{ $user->company->logo }} @endif" alt="" id="preview" style="max-height:150px">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10" class="form-control" required>{{ $user->company->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <center><input type="submit" value="Update" id="" class="btn btn-primary"></center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#user').addClass('mm-active')
        $('#employee').addClass('mm-active')
        var LoadImage = function(event) {
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection