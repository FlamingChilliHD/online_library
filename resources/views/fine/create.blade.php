@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @php
            $messages = [];
            if ($msg = session('fine_pay')) $messages[] = $msg;
        @endphp

        @if(!empty($messages))
            <div class="alert alert-danger">
                <ul>
                    @foreach($messages as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('fine_store', $loan) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="fine_amount" class="form-label">Fine Amount</label>
                <input type="text" name="fine_amount" id="fine_amount" class="form-control" value="{{ $loan->fine_amount }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Pay Fine</button>
        </form>
    </div>
@endsection
