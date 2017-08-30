@extends('layouts.app')

@section('title')
    Laravel Shopping cart
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if(\Session::has('basket'))
                    <?php $total=0;  ?>
                @foreach(\Session::get('basket') as $product)

                                @php $total+= $product->price; @endphp
                                    <div class="media">
                                        <div class="media-left">
                                            <a href="#">
                                                    <img style="width: 64px; height:64px;" class="media-object" src="{{ asset($product->img_path) }}" alt="{{ asset($product->title) }}">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">{{ asset($product->title) }}</h4>
                                                {{ asset($product->description) }}
                                        </div>
                                        <span class="badge">{{ $product->price }} so'm</span>
                                    </div>

                @endforeach
                <br>Total Price :  {{ $total }} so'm.
                @else

                    <h3>You did not choose any of products yet ! Please <a href="/">choose</a> </h3>

                @endif
            </div>
        </div>
    </div>

@endsection

