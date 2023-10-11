@extends('layout.frontend')
@section('title', 'Mero Placement | Payment Methods')
@section('body')
<!-- End banner Area -->
    <section>
        <div class="container">
            <div class="row">
                @foreach ($payments as $payment)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">{{ $payment->title }}</div>
                            <img src="/uploads/{{ $payment->photo }}" style="border:0px;width:100%">
                            <div class="card-body">
                                <p>Account Name : {{ $payment->acc_name }}</p>
                                <p>Account Number : {{ $payment->acc_number }}</p>
                                <p>Account Type : <i>{{ $payment->type }}</i></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('script')
    <style>
        section .container {
            padding: 100px 0;
            color: black;
            font-weight: 600;
        }
        .card {
            margin-bottom:20px
        }
    </style>
@endsection