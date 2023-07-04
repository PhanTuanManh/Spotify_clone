@extends('product.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Name"
                        value="{{ $product->product_name }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="number" name="price" class="form-control" placeholder="Price"
                        value="{{ $product->product_price }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Category:</strong>
                    <select name="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Image:</strong>
                            <img src="{{ asset('image/product/' . $product->product_image) }}" alt="" border=3
                                height=150 width=200>
                        </div>
                    </div>
                    <input type="file" class="form-control" placeholder="Image" value="{{ $product->product_image }}" name="product_image" />
                </div>
            </div> --}}

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Product Image:</strong>
                            <img src="{{ asset('image/product/' . $product->product_image) }}" alt="" border=3
                                height=150 width=200>
                        </div>
                    </div>
                    <input type="file" class="form-control" placeholder="Product Image" value="{{ $product->product_image }}" name="product_image" />
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Audio:</strong>
                            <source src="{{ asset('audio/product/' . $product->audio) }}" class="form-control>"
                                id="audio" placeholder="Audio" value="" name="audio">
                        </div>
                    </div>
                    <input type="file" id="audioProduct" name="audioProduct" accept="audio/*">

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $product->product_description }}</textarea>
                </div>
                <div class="form-group">
                    <strong>Lyric:</strong>
                    <textarea class="form-control" style="height:150px" name="lyric" placeholder="lyric">{{ $product->lyric }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
