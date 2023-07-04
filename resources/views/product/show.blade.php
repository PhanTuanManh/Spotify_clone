@extends('product.layout')
  
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $product->product_name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
               
                <img src="{{ asset('image/product/'.$product->product_image) }}" alt="" border=3 height=150 width=200 class="images-detail img">
            </div>
        <div class="col-xs-12 col-sm-12 col-md-12"> 
            <div class="form-group">
            <td>
            <audio controls controlsList="nodownload" style="width: 250px;" ontimeupdate="myAudio(this)">
                <source src="{{ asset('audio/product/'.$product->audio) }}" type="audio/mpeg">
                </audio>
                <script type="text/javascript">
                    function myAudio(event){
                        if(event.currentTime>10){
                            event.currentTime=0;
                            event.pause();
                            alert("Bạn phải trả phí để nghe cả bài")
                        }
                    }
                </script>
            </td>

        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Price:</strong>
                {{ $product->product_price }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Category:</strong>
                {{ $product->category_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Details:</strong>
                {{ $product->product_description }}
            </div>
            <div class="form-group">
                <strong>Lyric:</strong>
                {{ $product->lyric }}
            </div>
        </div>
    </div>
@endsection
