@extends('layout.employee')
@section('title', $user->name)
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Dashboard </div>
                </div>
                <div class="page-title-actions">
                    <button type="button" class="btn-shadow mr-3 btn btn-dark" id="editBTN" onclick="enableEdit()">
                        <i class="fa fa-edit"></i> Edit
                    </button>
                </div>
            </div>
        </div>
        <div class="container card card-body">
            <form action="{{ route('employee.logo.update') }}" id="updateLogo" enctype="multipart/form-data" method="post" style="display:none">
            @csrf
            <input type="file" name="logo" id="logo" onchange="$('#updateLogo').submit()">
            </form>
            <div class="form-group">
                <center>
                    <img src="/uploads/{{ $user->company->logo }}" class="img-profile rounded-circle">
                    <button class="btn btn-info" onclick=" $('#logo').click() " id="logoUpdate" style="display: none">Select Logo</button>
                </center>
                    
            </div>
            <form action="{{ route('employee.update',$user->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="name">Company Name <span style="color: red">*</span></label>
                        <input type="text" class="form-control" required value="{{ $user->name }}" name="name" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="email">Company Email <span style="color: red">*</span></label>
                        <input type="email" class="form-control" required value="{{ $user->email }}" name="email" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="number">Company Number <span style="color: red">*</span></label>
                        <input type="number" class="form-control" required value="{{ $user->number }}" name="number" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="indsutry_id">Industry <span style="color: red">*</span></label>
                        <select name="indsutry_id" id="indsutry_id" class="form-control" required disabled>
                            @foreach ($industries as $i)
                                <option value="{{ $i->id }}" @if($i->id == $user->company->industry_id) selected @endif>{{ $i->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="address">Company Address <span style="color: red">*</span></label>
                        <input type="text" class="form-control" required value="{{ $user->company->address }}" name="address" disabled>
                    </div>
                    <div class="col-md-4">
                        <label for="website">Company Website</label>
                        <input type="text" class="form-control" value="{{ $user->company->website }}" name="website" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description <span style="color: red">*</span></label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" disabled>{{ $user->company->description }}</textarea>
                </div>
                <div class="form-group">
                    <center>
                        <input type="submit" value="Update" class="btn btn-primary" style="display: none" id="updateBTN" disabled>
                    </center>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#dashboard').addClass('mm-active')
        function enableEdit() {
            $( "input" ).removeAttr( "disabled" )
            $( "textarea" ).removeAttr( "disabled" )
            $( "select" ).removeAttr( "disabled" )
            $('#logoUpdate').show()
            $('#updateBTN').show()
            $('#editBTN').hide()
        }
    </script>
    <style>
        .img-profile {
            max-height: 200px;
            width:auto;
            margin: auto
        }
        input:disabled {
            color: black
        }
    </style>
@endsection