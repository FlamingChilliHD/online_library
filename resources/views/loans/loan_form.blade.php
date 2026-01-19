@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        @php
            $messages = [];
            if ($msg = session('invalid_date')) $messages[] = $msg;
            if ($msg = session('no_stock')) $messages[] = $msg;
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

        <form action="{{ route('loan_store', $book) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="due_date" class="form-label">Loan Due Date</label>
                <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Reserve Book</button>
            <a href="{{ route('books_index') }}" class="btn btn-secondary" style="margin-left: 10px">Return to gallery.</a>
        </form>
    </div>
@endsection
