@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Book List</h2>
                    <a href="{{ route('book.create') }}" class="btn btn-primary">Add New Book</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Book Name</th>
                                    <th>Drawer</th>
                                    <th>Author</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($books as $book)
                                    <tr>
                                        <td>{{ $book->getId() }}</td>
                                        <td>{{ $book->getCategory() }}</td>
                                        <td>{{ $book->getName() }}</td>
                                        <td>{{ $book->getDrawer() }}</td>
                                        <td>{{ $book->getAuthor() }}</td>
                                        <td>
                                            <a href="{{ route('book.show', $book->getId()) }}" 
                                               class="btn btn-info btn-sm">View</a>
                                            <a href="{{ route('book.edit', $book->getId()) }}" 
                                               class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('book.destroy', $book->getId()) }}" 
                                                  method="POST" 
                                                  style="display: inline-block;"
                                                  onsubmit="return confirm('Are you sure you want to delete this book?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No books found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .table th {
        background-color: #f8f9fa;
    }
    .btn-group {
        gap: 5px;
    }
</style>
@endpushp