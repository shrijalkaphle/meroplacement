@extends('layout.admin')
@section('title', 'Edit Job | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Edit Job </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 py-3 card card-body">
                    <form action="{{ route('job.premium.update',$job->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" required value="{{ $job->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select name="company_id" id="" class="form-control" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" @if($job->company_id == $company->id) selected @endif>{{ $company->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                           <div class="form-group row">
                            <div class="col-md-6">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" id="" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <img src="/uploads/{{ $job->logo }}" style="height:150px;width:150px">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="industry_id">Job Industry</label>
                            <select name="industry_id" id="" class="form-control" required>
                                @foreach ($industries as $industry)
                                    <option value="{{ $industry->id }}" @if($job->industry_id == $industry->id) selected @endif>{{ $industry->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="address">Job Address</label>
                                <input type="text" name="address" class="form-control" value="{{ $job->address }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="deadline">Job Deadline</label>
                                <input type="date" name="deadline" class="form-control" value="{{ $job->deadline }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description(max. 250 characters)</label>
                            <textarea name="description" id="description" cols="30" rows="10" required class="form-control" maxlength="250">{{ $job->description }}</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="0" @if($job->status == '0') selected @endif>Expired</option>
                                    <option value="1" @if($job->status == '1') selected @endif>Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <center> <input type="submit" value="Update" class="btn btn-primary"> </center>
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
        $('#job').addClass('mm-active')
        $('#premium').addClass('mm-active')
    </script>
@endsection