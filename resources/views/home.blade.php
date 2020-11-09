@extends('layouts.app')
@section('content')

<div class="wrapper">
  @forelse( $books as $book )
  <div class="panel">
    <div class="content-wrapper">
      <img class="w-100" src="{{ $book->image }}">
      <h5 class="mt-2 ml-2">{{ $book->title }}</h5>
    </div>
    <div class="button-wrapper">
      <button type="button" class="btn btn-outline-success btn-md" data-toggle="modal" data-target="{{ '#view' . $book->id }}">
        View
      </button>
      <button type="button" class="btn btn-outline-primary btn-md" data-toggle="modal" data-target="{{ '#edit' . $book->id }}">
        Edit
      </button>
      <button type="button" class="btn btn-outline-danger btn-md" data-toggle="modal" data-target="{{ '#delete' . $book->id }}">
        Delete
      </button>
    </div>
  </div>

  @component('components.modal')
  @slot('modalId', 'view' . $book->id)
  @slot('header', $book->title)

  <img class="w-100" src="{{ $book->image }}" alt="{{ $book->title }}">
  <p class="text-muted mt-2">
    Author: {{ $book->author }}
    <br>
    Number of Pages: {{ $book->pages }} pages
  </p>
  <p>
    Updated at: {{ $book->updated_at }}
    <br>
    Created at: {{ $book->created_at }}
  </p>

  @endcomponent

  @component('components.modal')
  @slot('modalId', 'edit' . $book->id)
  @slot('header', $book->title)

  <form action="{{ route('books.update', $book->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="md-form mb-2">
      <input type="text" id="orangeForm-name" class="form-control validate" name="title" placeholder="Title" value="{{ $book->title }}">
    </div>
    <div class="md-form mb-2">
      <input type="text" id="orangeForm-email" class="form-control validate" name="author" placeholder="Author" value="{{ $book->author }}">
    </div>

    <div class="md-form mb-2">
      <input type="number" id="orangeForm-pass" class="form-control validate" name="pages" placeholder="Total Pages" value="{{ $book->pages }}">
    </div>

    <div class="md-form mb-2">
      <input type="file" name="image">
    </div>

    @slot('footer')
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
  @endslot
  @endcomponent

  @component('components.modal')
  @slot('modalId', 'delete' . $book->id)
  @slot('header', 'Delete ' . $book->title . '?')

  <p class="text-muted">This book will be permanently deleted. Are you sure?</p>

  @slot('footer')
  <form action="{{ route('books.destroy', $book->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit" class="btn btn-danger">Sure</button>
  </form>
  @endslot
  @endcomponent

  @empty
  <h6 class="text-muted">No books were found!</h6>

  @endforelse
</div>

@endsection