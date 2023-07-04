@extends('product.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>MUSIC</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
            <div class="pull-left">
                <a class="btn btn-success" href="{{ route('category.index') }}"> Management Category</a>
            </div>
            <div class="mb-3">
                <a class="btn btn-danger" href="{{ route('home.index') }}">HOME</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Audio </th>
            <th>Details</th>
            <th>Lyric</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $key => $product)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->product_price }}</td>
                <td>{{ $product->category_id }}</td>
                <td><img src="{{ asset('image/product/' . $product->product_image) }}" alt="" border=3 height=150
                        width=200 class="images-detail img"></td>
                <td>
                    <audio controls controlsList="nodownload noplaybackrate nocurrenttime nodetails" class="audiplay" style="width: 250px;" ontimeupdate="myAudio(this)">
                        <source src="{{ asset('audio/product/' . $product->audio) }}" type="audio/mpeg">
                    </audio>
                    {{-- <script type="text/javascript">
                    function myAudio(event){
                        if(event.currentTime>10){
                            event.currentTime=0;
                            event.pause();
                            alert("Bạn phải trả phí để nghe cả bài")
                        }
                    }
                </script> --}}
                </td>

                <td>{{ $product->product_description }}</td>
                <td>
                    <form action="{{ route('products.destroy', $product->product_id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('products.show', $product->product_id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('products.edit', $product->product_id) }}">Edit</a>

                        <a class="btn btn-primary" href="{{ route('products.destroy', $product->product_id) }}">Delete</a>

                    </form>
                </td>
                <td>
                    <p class="desc-lyric">{{ $product->lyric }}
                    <p>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
