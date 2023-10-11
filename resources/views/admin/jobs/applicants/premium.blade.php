@extends('layout.admin')
@section('title', 'Premium Jobs Applicant | Admin Pannel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Applicant of <b>{{ $job->title }}</b> </div>
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
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 py-3 card">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Education</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($job->applicant as $applicant)
                                    <tr>
                                        <th>{{ $applicant->name }} </th>
                                        <td class="text-center"><a href="mailto:{{ $applicant->email }}">{{ $applicant->email }}</a></td>
                                        <td class="text-center"><a href="tel:{{ $applicant->mobile }}">{{ $applicant->mobile }}</a></td>
                                        <td class="text-center">{{ $applicant->address }}</td>
                                        <td class="text-center">{{ $applicant->education }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary" onclick="download('{{$applicant->resume}}')" @if(!$applicant->resume) disabled @endif>Download</button>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')" href="/premium/applicant/delete/{{$applicant->id}}">Delete</a>
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

@section('script')
    <script>
        $('#job').addClass('mm-active')
        $('#premium').addClass('mm-active')

        function viewProfile(id) {
            alert(id)
        }
        function download(file) {
            var uri = '/uploads/' + file;
            var link = document.createElement("a");
            link.href = uri;
            document.body.appendChild(link);
            link.click();
            link.remove();
        }
    </script>
@endsection