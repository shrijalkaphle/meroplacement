@extends('layout.admin')
@section('title', 'Admin Pannel')
@section('body')

<style>
    #table_id_filter{
        float:right;
        padding: 20px;
    }
    
    #table_id_filter input{
        padding: 5px;
    }
    
    .dataTables_length{
        display:none;
    }
</style>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Applicant </div>
                </div>
            </div>
        </div> 
        <div class="row">
            <div class="col-md-12">
               
                </br>
                <div class="main-card mb-3 py-3 card ">
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover" id="table_id">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th class="text-center">Company</th>
                                <th class="text-center">Applicant Count</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Posted On</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($jobs as $job)
                                    <tr>
                                        <th> {{ $job->title }} </th>
                                        <td class="text-center">{{ $job->company->user->name }}</td>
                                        <td class="text-center">{{ $job->applicant_count }}</td>
                                        <td class="text-center">
                                            <div class="badge badge-danger">{{ date('M j, Y',strtotime($job->deadline)) }}</div>
                                        </td>
                                        <td class="text-center">
                                            <div class="badge badge-info">{{ date('M j, Y',strtotime($job->created_at)) }}</div>
                                        </td>
                                        <td class="text-center">
                                            <a type="button" id="PopoverCustomT-1" style="color:white" href="{{ route('applicant.show', $job->id) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                      
                        </table>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{$jobs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#table_id').DataTable();
    });
</script>


@endsection



@section('script')

    <script>
        $('#applicant').addClass('mm-active')
  
   
    </script>
    
@endsection