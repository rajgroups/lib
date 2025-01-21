<!doctype html>
<html lang="en">

<head>
    <title>Book Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <nav class="navbar navbar-expand-sm navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Library System</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID"
                    aria-controls="navbarID" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarID">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        <a class="nav-link" aria-current="page" href="{{ route('book.index') }}">Book List</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card mt-4">
                    {{-- <img src="https://images.unsplash.com/photo-1561154464-82e9adf32764?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60" class="card-img-top" alt="..."> --}}
                    <div class="card-header">
                        <h5 class="card-title text-center">Book Edit</h5>
                    </div>
                    <div class="card-body">
                       
                            <form action="{{ route('book.update',$book->id) }}" method="post" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <input type="hidden" name="id" value="{{ $book->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                         <!-- Display validation errors -->
                                            @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if(session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
        
                                        @if(session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                    </div>
                                <div class="col-md-4">
                                    <label for="book-title">Book Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="book-title">Book Author</label>
                                    <select id="author" name="author" class="form-select">
                                        @forelse ($authors as $author)
                                            @if($book->author == $author->name)
                                                <option selected value="{{ $author->id }}">{{ $author->name }}</option>
                                            @endif
                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @empty
                                        <option value="">Sorry! Please Add Author First</option> 
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    {{-- 'fiction','non-fiction','sci-fi','etc' --}}
                                    <label for="book-title">Genre</label>
                                    <select id="genre" name="genre" class="form-select">
                                       <option {{ ($book->genre == 'fiction') ? 'selected':''  }} value="fiction">Fiction</option>
                                       <option {{ ($book->genre == 'non-fiction') ? 'selected':''  }} value="non-fiction">Non-fiction</option>
                                       <option {{ ($book->genre == 'sci-fi') ? 'selected':''  }} value="sci-fi">sci-fi</option>
                                       <option {{ ($book->genre == 'etc') ? 'selected':''  }} value="etc">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    {{-- 'fiction','non-fiction','sci-fi','etc' --}}
                                    <label for="book-title">Price</label>
                                    <select id="price" name="price" class="form-select">
                                        {{-- <option {{ ($book->price == '10') ? 'selected':''  }} value="10">10</option> --}}
                                       <option {{ ($book->price == '10') ? 'selected':''  }} value="10">$10</option>
                                       <option {{ ($book->price == '15') ? 'selected':''  }} value="15">$15</option>
                                       <option {{ ($book->price == '20') ? 'selected':''  }} value="20">$20</option>
                                       <option {{ ($book->price == '25') ? 'selected':''  }} value="25">$25</option>
                                       <option {{ ($book->price == '30') ? 'selected':''  }} value="30">$30</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    {{-- 'fiction','non-fiction','sci-fi','etc' --}}
                                    <label for="book-title">Format</label>
                                    <select id="format" name="format" class="form-select">
                                       <option {{ ($book->format == 'hardcover') ? 'selected':''  }} value="hardcover">hardcover</option>
                                       <option {{ ($book->format == 'paperback') ? 'selected':''  }} value="paperback">paperback</option>
                                       <option {{ ($book->format == 'ebook') ? 'selected':''  }} value="ebook">ebook</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="book-title">ISBN Number</label>
                                    <input type="text" class="form-control" id="isbn" name="isbn" value="{{ $book->isbn }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="book-title">Qty</label>
                                    <input type="text" class="form-control" id="qty" name="qty" 
                                           value="{{ $quantities->first()->qty ?? '' }}" required>
                                </div>
                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary mt-3">Update Book</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
