@extends('AdminPanel.layout.main')

@section('main-container')
<div class='mt-3 container'>
    <h3>Products</h3>
    <hr>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <form class="d-flex" action="">
                <input class="form-control me-5 mr-sm-2" type="search" value="{{ $search }}" name="search"
                placeholder="Search by name" aria-label="Search" style="width: 500px;">
                <button class="btn btn-dark">Search</button>
                <span style="margin-left: 10px;">
                    <a href="{{ url('/Adminproduct') }}">
                        <button class="btn btn-dark" type="button">Reset</button>
                    </a>
                </span>
            </form>
            <div class="d-flex">
                <button type="button" onclick="window.location='{{ url('/Adminproductform') }}'" class="btn btn-dark btn-circle font-rights me-2">
                    <i class="bi bi-plus"></i> Add
                </button>
                <a href="{{ url('/Adminproducttrash') }}">
                    <button class="btn btn-danger ml-2">
                        Trashed Data
                    </button>
                </a>
            </div>
        </div>
    </nav>

    <div class="card mt-2" style="width:65rem;">
        <div class="card-body">
            <div class="table-responsive text-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 40%;">Image</th>
                            <th style="width: 40%;">Img1</th>
                            <th style="width: 40%;">Img2</th>
                            <th style="width: 40%;">Img3</th>
                            <th style="width: 40%;">Img4</th>
                            <th style="width: 8%;">Product Id</th>
                            <th style="width: 10%;">Category</th>
                            <th style="width: 10%;">Subcategory</th>
                            <th style="width: 15%;">Name</th>
                            <th style="width: 17%;">Description</th>
                            <th style="width: 10%;">MRP Price</th>
                            <th style="width: 10%;">Discount Price</th>
                            <th style="width: 10%;">Created_at</th>
                            <th style="width: 10%;">Updated_at</th>
                            <th colspan="2" style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset('productsimg/' . $product->image) }}" class="img-fluid rounded"
                                    alt="Image" style="width: 500px; height: 70px">
                            </td>
                            <td>
                                <img src="{{ asset('productsimg/' . $product->img1) }}" class="img-fluid rounded"
                                    alt="Image" style="width: 500px; height: 70px">
                            </td>
                            <td>
                                <img src="{{ asset('productsimg/' . $product->img2) }}" class="img-fluid rounded"
                                    alt="Image" style="width: 500px; height: 70px">
                            </td>
                            <td>
                                <img src="{{ asset('productsimg/' . $product->img3) }}" class="img-fluid rounded"
                                    alt="Image" style="width: 500px; height: 70px">
                            </td>
                            <td>
                                <img src="{{ asset('productsimg/' . $product->img4) }}" class="img-fluid rounded"
                                    alt="Image" style="width: 500px; height: 70px">
                            </td>
                            <td>{{ $product->product_id }}</td>
                            <td>{{ $product->category ? $product->category->name : 'N/A' }}</td>
                            <td>{{ $product->subcategory ? $product->subcategory->name : 'N/A' }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount_price }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                            <td>
                                <a href="{{ route('product.edit', ['id' => $product->product_id]) }}">
                                    <button class="btn btn-primary">Update</button>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('product.delete', ['id' => $product->product_id]) }}">
                                    <button class="btn btn-danger">Trash</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
