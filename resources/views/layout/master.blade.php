<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('./style') }}/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <section class="body-section">

    </section>

    <section>
        <div class="main-section">
            <div class="left-side">
                <ul>
                    <li>
                        <a href="{{ route('books') }}">All Books</a>
                    </li>
                    <li>
                        <a href="{{ route('books.create') }}">Create</a>
                    </li>
                </ul>
            </div>
            <div class="right-side">
                @yield('content')
            </div>
        </div>
    </section>


    @yield("massege")
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>

    <script>
        @if (session('success'))
            alert("{{ session('success') }}");
        @endif
    </script>
</html>