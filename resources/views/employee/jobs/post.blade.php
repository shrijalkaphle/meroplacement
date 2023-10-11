@extends('layout.employee')
@section('title', 'Create New Job')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Create New Job </div>
                </div>
            </div>
        </div>
        <div class="container card card-body">
            <form action="{{ route('employee.jobpost.store') }}" method="post" enctype= "multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" required id="" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" id="" class="form-control" required>
                </div>
                <div class="form-group row">
                    <div class='col-md-6'>
                        <label for="industry_id">Job Industry</label>
                        <select name="industry_id" id="" class="form-control" required>
                            @foreach ($industries as $industry)
                                <option value="{{ $industry->id }}">{{ $industry->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                             <div class='col-md-6'>
                                 <label for="nature">Education Requirement</label>
                                <input type="text" name="education" class="form-control" required>
                                
                            </div>
                            
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <label for="nature">Job Type</label>
                        <input type="text" name="nature" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="location">Job Location</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label for="vacancyno">Number of Vacancy</label>
                        <input type="text" name="vacancyno" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="salary">Salary</label>
                        <input type="text" name="salary" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="deadline">Job Deadline</label>
                        <input type="date" name="deadline" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <center>
                        <button class="btn btn-primary">Add</button>
                    </center>
                </div>
            </form>
            
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#postjob').addClass('mm-active')
        ClassicEditor.create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            }
        );
    </script>
@endsection