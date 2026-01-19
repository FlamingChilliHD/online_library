@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Book Loan</h1>

        @php
            $messages = [];
            if ($msg = session('success')) $messages[] = $msg;
        @endphp

        @if(!empty($messages))
            <div class="alert alert-success">
                <ul>
                    @foreach($messages as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Category</th>
                    <th>Loan Duration</th>
                    <th>Borrowed At</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                    <tr>
                        <td>{{ $loan->book->title }}</td>
                        <td>{{ $loan->book->author }}</td>
                        <td>{{ $loan->book->ISBN }}</td>
                        <td>{{ $loan->book->category->name }}</td>
                        <td>{{ $loan->due_date }}</td>
                        <td>{{ $loan->borrowed_at }}</td>
                        <td>
                            <a href="{{ route('loan_update', $loan) }}" class="btn btn-warning">Return Book</a>
                        </td>
                    </tr>
            </tbody>
        </table>

    </div>
@endsection
