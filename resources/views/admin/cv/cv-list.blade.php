@extends('layout.admin')
@section('title', 'CV Access List | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> CV Access List </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 py-3 card ">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-center">JobSeeker Name</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($cvrequest->cvlist as $cv)
                                <tr>
                                    <th>#</th>
                                    <td class="text-center">{{ $cv->jobseeker->user->name }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-primary" target="_blank" href="{{ route('jobseeker.view',$cv->jobseeker->user->id) }}">View</a>
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