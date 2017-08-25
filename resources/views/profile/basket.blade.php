@extends('layouts.app')

@section('title')
    Laravel Shopping cart
@endsection

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach(\Session::get('basket') as $item)
                    {{ dd($item) }}
                @endforeach
            </div>
        </div>
    </div>



@endsection

