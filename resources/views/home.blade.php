@extends('layouts.app')

@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <hr>
                    <div class="parent">
                        <a href="{{ route('books_index') }}" class="btn btn-primary mb-3">Book Gallery</a>
                        <a href="{{ route('loans_index') }}" class="btn btn-success mb-3">My Current Loans</a>
                        <a href="{{ route('loans_returned') }}" class="btn btn-dark mb-3">My Returned Loans</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
