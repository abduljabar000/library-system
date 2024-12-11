@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2>Book Details</h2>
                    <a href="{{ route('book.index') }}" class="btn btn-secondary">Back to List</a>
                </div>

                <div class="card-body">
                    @if($book)
                        <dl class="row">
                            <dt class="col-sm-3">ID</dt>
                            <dd class="col-sm-9">{{ $book->getId() }}</dd>

                            <dt class="col-sm-3">Category</dt>
                            <dd class="col-sm-9">{{ $book->getCategory() }}</dd>

                            <dt class="col-sm-3">Name</dt>
                            <dd class="col-sm-9">{{ $book->getName() }}</dd>

                            <dt class="col-sm-3">Drawer</dt>
                            <dd class="col-sm-9">{{ $book->getDrawer() }}</dd>

                            <dt class="col-sm-3">Author</dt>
                            <dd class="col-sm-9">{{ $book->getAuthor() }}</dd>
                        </dl>
                    @else
                        <p class="text-center">Book not found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
