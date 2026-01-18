@extends('layout.master')
@section('content')
    <section>
        <div class="row  m-3">
            <div class="card p-3 ">
                <div class="d-flex gap-3">
                    <form action="{{ route('books.search.title') }}" method="POST">
                        @csrf
                        
                        <div class="d-flex gap-3">
                            
                            <div class="d-flex align-items-center gap-2">
                                <input type="text" class="form-control @error('search') is-invalid @enderror" name="search"
                                placeholder="Search title or author" style="max-width: 250px;">
                                <button class="btn btn-success">Search</button>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('books.search.price') }}" method="POST">
                        @csrf

                        <div class="d-flex gap-3">
                            
                            
                        <div class="d-flex align-items-center gap-2">
                            <input type="number" class="form-control @error('lowPrice') is-invalid @enderror"
                            name="lowPrice" placeholder="0" style="max-width: 150px;">
                            
                            to
                            
                            <input type="number" class="form-control @error('highPrice') is-invalid @enderror"
                            name="highPrice" placeholder="999" style="max-width: 150px;">
                            <button class="btn btn-success">Search</button>
                        </div>
                        
                    </div>
                </form>
            </div>

            </div>
        </div>
    </section>
    <section>
        <div>
            <table class="table m-3">
                <thead>
                    <tr>
                        <th>S.L</th>
                        <th>Title</th>
                        <th>Auther</th>
                        <th>ISBN</th>
                        <th>Price</th>
                        <th>quantity</th>
                        <th>Published Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $view)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $view->title }}</td>
                            <td>{{ $view->author }}</td>
                            <td>{{ $view->isbn }}</td>
                            <td>{{ $view->price }}</td>
                            <td>
                                @if($view->quantity == 0)
                                    <span class="badge bg-danger">Out of stock</span>
                                @elseif($view->quantity <= 5)
                                    <span class="badge bg-warning text-dark">{{ $view->quantity }} Low Stock</span>
                                @else
                                    <span class="badge bg-success">{{ $view->quantity }}</span>
                                @endif
                            </td>
                            <td>{{ $view->published_date }}</td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7">No Data found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3">
                {{ $books->links() }}
            </div>
        </div>
    </section>

@endsection