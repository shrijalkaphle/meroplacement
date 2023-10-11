@extends('layout.admin')
@section('title', 'Edit Job | Admin Pannel')
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
                    <form action="{{ route('job.active.update',$job->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" required value="{{ $job->title }}" class="form-control">
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
                            <label for="company_id">Company</label>
                            <select name="company_id" id="" class="form-control" required>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" @if($job->company_id == $company->id) selected @endif>{{ $company->user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class='col-md-6'>
                                <label for="industry_id">Job Industry</label>
                                <select name="industry_id" id="" class="form-control" required>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry->id }}" @if($job->industry_id == $industry->id) selected @endif>{{ $industry->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                              <div class='col-md-6'>
                                 <label for="nature">Education Requirement</label>
                                <input type="text" name="education" value='{{ $job->education}}' class="form-control" required>
                                
                            </div>
                            
                            
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="nature">Job Nature</label>
                                <input type="text" name="nature" class="form-control" value="{{ $job->nature }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="location">Job Location</label>
                                <input type="text" name="location" class="form-control" value="{{ $job->location }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="vacancyno">Number of Vacancy</label>
                                <input type="text" name="vacancyno" class="form-control" value="{{ $job->vacancyno }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="salary">Salary</label>
                                <input type="text" name="salary" class="form-control" value="{{ $job->salary }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="deadline">Job Deadline</label>
                                <input type="date" name="deadline" class="form-control" value="{{ $job->deadline }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10">{{ $job->description }}</textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active" @if($job->status == 'active') selected @endif>Active</option>
                                    <option value="pending" @if($job->status == 'pending') selected @endif>Pending</option>
                                    <option value="expired" @if($job->status == 'expired') selected @endif>Expired</option>
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
        ClassicEditor.create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            }
        );
    </script>
@endsection