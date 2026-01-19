@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>My Loans</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Category</th>
                    <th>Borrowed At</th>
                    <th>Loan Duration</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td>{{ $loan->book->title }}</td>
                        <td>{{ $loan->book->author }}</td>
                        <td>{{ $loan->book->ISBN }}</td>
                        <td>{{ $loan->book->category->name }}</td>
                        <td>{{ $loan->borrowed_at }}</td>
                        <td>{{ $loan->due_date }}</td>
                        <td>
                            <a href="{{ route('loan_update', $loan) }}" class="btn btn-warning">Return Book</a>
                        </td>
                    </tr>
                    @empty
                    <p>No currently existing loans</p>
                @endforelse
            </tbody>
        </table>

        <hr>
        {{ $loans->links() }}
    </div>
@endsection
