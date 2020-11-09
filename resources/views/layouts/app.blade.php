<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token untuk pengamanan inputan -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ env('APP_NAME') }}</title>

  <script src="{{ asset('js/app.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="{{ route('books.index') }}">
        {{ env('APP_NAME') }}
      </a>

      <div>
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="{{ route('books.index') }}" class="nav-link">All Catalogs</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#new">
              New Book
            </a>

            @component('components.modal')
            @slot('modalId', 'new')
            @slot('header', $book->title)

            <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="md-form mb-2">
                <input type="text" id="orangeForm-name" class="form-control validate" name="title" placeholder="Title">
              </div>
              <div class="md-form mb-2">
                <input type="text" id="orangeForm-email" class="form-control validate" name="author" placeholder="Author">
              </div>

              <div class="md-form mb-2">
                <input type="number" id="orangeForm-pass" class="form-control validate" name="pages" placeholder="Total Pages">
              </div>

              <div class="md-form mb-2">
                <input type="file" name="image">
              </div>

              @slot('footer')
              <button type="submit" class="btn btn-success">Save</button>
            </form>
            @endslot
            @endcomponent

          </li>
        </ul>

    </nav>

    <main class="py-5">
      @yield('content')
    </main>

    <footer class="fixed bottom-0">
      <div class="blockquote-footer text-center pt-3">
        <p>&copy; {{ date('Y') }} NAMA KELOMPOK.</p>
      </div>
    </footer>
  </div>
</body>

</html>