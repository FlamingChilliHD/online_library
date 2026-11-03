@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Librarian Dashboard</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Category</th>
                    <th>Borrowed</th>
                    <th>Due</th>
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
                        <td>{{ $loan->getBorrowDate() }}</td>
                        <td>{{ $loan->getDueDate() }}</td>
                        <td>
                            <form method="POST" action="{{ route('loan_update', $loan) }}">
                                @csrf
                                @method('PUT')
                                <button class="btn btn-warning">Return Book</a>
                            </form>
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
