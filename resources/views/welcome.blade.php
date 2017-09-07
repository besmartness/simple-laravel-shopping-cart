@extends('layouts.app')

@section('title')
Laravel Shopping
@endsection

@section('content')

      <div class="container">
      <div class="row">
          <div class="col-md-10 col-md-offset-1">

        @foreach($model->chunk(3) as $product_array)
            <div class="row">
        @foreach($product_array as $item)
              <div class="col-sm-6 col-md-4">
                   <div class="thumbnail">
                      <img src="{{ asset($item->img_path) }}" alt="">
                      <div class="caption">
                         <h3>{{ $item->title }}</h3>
                          <p>{{ $item->description }}</p>
                          <p><a href="{{ route('addToBasket', ['id' => $item->id]) }}" @if(Auth::check()) {{ 'id="song"' }} @endif class="btn btn-success" role="button">Sotib olish</a><span style="float: right;">{{ $item->price }} so'm</span></p>
                      </div>
                  </div>
              </div>
            @endforeach
          </div>
        @endforeach
        </div>
      </div>
    </div>

@endsection
@section('script')

    <script type="text/javascript">
                @if(Session::has('basket'))

        var path = "{{ asset('song.mp3') }}";
        var snd = new Audio(path);
        snd.play();
        @endif

    </script>
@endsection