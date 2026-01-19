@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Book Gallery</h1>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>ISBN</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->ISBN }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>{{ $book->category->name }}</td>
                        <td>
                            <a href="{{ route('loan_create', $book) }}" class="btn btn-primary">Loan Book</a>
                        </td>
                    </tr>
                    @empty
                    <p>No books</p>
                @endforelse
            </tbody>
        </table>

        {{ $books->links() }}
    </div>
@endsection
