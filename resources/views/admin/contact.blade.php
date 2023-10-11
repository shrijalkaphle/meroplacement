@extends('layout.admin')
@section('title', 'Contact Form | Admin Panel')
@section('body')
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div> Contact Form Message </div>
                </div>

            </div>
        </div>
      
        
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 py-3 card ">
                    <div class="table-responsive">
                       <form action='/deleteAll' method='POST'>
                        @csrf
                        <input type='submit' class='btn btn-primary' value='Delete All Selected'>
                       <table class="table fixed-table">
                            <thead>
                                <th>Check</th>
                                <th>#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Contact</th>
                                <th class="text-center">Subject</th>
                                <th class="text-center" style="width:45%">Message</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    <tr>
                                        <td><input type="checkbox" name="ids[{{$contact->id}}]" value='{{$contact->id}}'></td>
                                        <th>#</th>
                                        <td class="text-center"> {{ $contact->name }}</td>
                                        <td class="text-center"> <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a> </td>
                                        <td class="text-center"> <a href="tel:{{ $contact->mobile }}">{{ $contact->mobile }}</a> </td>
                                        <td class="text-center"> {{ $contact->subject }} </td>
                                        <td class="text-center"> {{ $contact->message }} </td>
                                        <td class="text-right">
                                            <a href="/contact/delete/{{$contact->id}}" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        </form>
                    </div>
                    <div class="d-block text-center card-footer">
                        {{$contacts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

