@extends('layout.master')
@section('content')
    <section>
        @if (empty($booksEdit))
            <div class="m-5">
                <p>Create a new Post</p>
                <div class="card p-3">
                    <div class="mb-1 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Create form</label>

                    </div>
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-6">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{ Old('title') }}">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-6">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ Old('price') }}">
                                    @error('price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                        name="quantity" value="{{ Old('quantity') }}">
                                    @error('quantity')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Published Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control @error('price') is-invalid @enderror"
                                        name="publishedDate" value="{{ Old('publishedDate') }}">
                                    @error('publishedDate')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 mt-4">

                                <picture>
                                    <img id="port_image" src="../../public/defualt/defualt.jpg" alt=""
                                        style="width:100%; height: 200px; object-fit:contain;">
                                </picture><br>

                                <label class="form-label">Image</label>
                                <input
                                    onchange="document.getElementById('port_image').src =window.URL.createObjectURL(this.files[0]) "
                                    type="file" name="image" class="form-control hudai @error('image') is-invalid @enderror"
                                    aria-describedby="emailHelp">
                            </div>

                            <div class="col-6 mt-3">
                                <button class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        @else
            <div class="m-5">
                <p>Update your Post</p>
                <div class="card p-3">
                    <div class="mb-1 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Update form</label>

                    </div>
                    <form action="{{ route('books.update', $booksEdit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row">
                            <div class="col-6">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                        value="{{  $booksEdit->title }}">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror

                                </div>
                            </div>


                            <div class="col-6">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{  $booksEdit->price }}">
                                    @error('price')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                        name="quantity" value="{{  $booksEdit->quantity }}">
                                    @error('quantity')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Published Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control @error('publishedDate') is-invalid @enderror"
                                        name="publishedDate"
                                        value="{{ \Carbon\Carbon::parse($booksEdit->publishedDate)->format('Y-m-d') }}">
                                    @error('publishedDate')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-6 mt-4">

                                <picture>
                                    <img id="port_image" src="{{ asset('uploads/books/' . $booksEdit->image) }}" alt=""
                                        style="width:100%; height: 200px; object-fit:contain;">
                                </picture><br>

                                <label class="form-label">Image</label>
                                <input
                                    onchange="document.getElementById('port_image').src =window.URL.createObjectURL(this.files[0]) "
                                    type="file" name="image" class="form-control hudai @error('image') is-invalid @enderror"
                                    aria-describedby="emailHelp" value="{{  $booksEdit->image }}">
                            </div>

                            <div class="col-6 mt-3">
                                <button class="btn btn-success">Save</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        @endif

    </section>
    <section class="m-5">
        <div class="card table-responsive m-3">
            <table class="table m-3">
                <thead>
                    <tr>
                        <th>S.L</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Auther</th>
                        <th>ISBN</th>
                        <th>Price</th>
                        <th>quantity</th>
                        <th>Published Date</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $view)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><img src="{{ asset('uploads/books/' . $view->image) }}" alt="Book Image" width="50"></td>
                            <td>{{ $view->title }}</td>
                            <td>{{ $view->userFind->name }}</td>
                            <td>{{ $view->isbn }}</td>
                            <td>{{ $view->price }}</td>
                            <td>
                                @if($view->quantity == 0)
                                    <span class="badge bg-danger">Out of stock</span>
                                @elseif($view->quantity <= 5)
                                    {{ $view->quantity }} <span class="badge bg-warning text-dark"> Low Stock</span>
                                @else
                                    <span>{{ $view->quantity }}</span>
                                @endif
                            </td>
                            <td>{{ $view->published_date }}</td>
                            <td>
                                <a href="{{ route('books.edit', $view->id) }}" class="btn btn-success">Edit</a>
                                <a href="{{ route('books.delete', $view->id) }}" id="Deletebtu"
                                    class="btn btn-danger delete-btn">
                                    Delete
                                </a>

                            </td>

                        </tr>

                    @empty

                    @endforelse
                </tbody>
            </table>
            <div class="p-3">
                {{ $books->links() }}
            </div>

        </div>
    </section>

    <script>
        let dbtn = document.getElementById("Deletebtu");

        dbtn.addEventListener("click", function (event) {
            if (!confirm("Are you sure you want to delete this book?")) {
                event.preventDefault(); // stop link
            }
        });
    </script>
@endsection