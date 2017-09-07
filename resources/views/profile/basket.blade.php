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
                    @endforeach<br>Total Price :  <button type="button" class="btn btn-info btn-lg">{{ $total }}</button> so'm.<br>
                @else
                    <h3>You did not choose any of products yet ! Please <a href="/">choose</a> </h3>
                @endif
            </div>
            @if(isset($total))
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form action="{{ route('pay') }}" method="post" id="payment-form">
                            <input type="hidden" value="{{ $total }}" name="total">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Card number :</label>
                                <input type="text" name="card_number" class="form-control" id="card_number" placeholder="Example: 4242 4242 4242 4242">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Expiration month :</label>
                                <input type="text" class="form-control" name="exp_month" id="exp_month" placeholder="Example: 12">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Expiration year :</label>
                                <input type="text" name="exp_year" class="form-control" id="exp_year" placeholder="Example: 19 (2019)">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">CVC :</label>
                                <input type="text" class="form-control" name="cvc" id="cvc" placeholder="Example: 123">
                            </div>
                            <button type="button" class="btn btn-default submit-button">Submit</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/checkout.js') }}"></script>
    <script type="text/javascript">
        function stripeResponseHandler(status, response) {
            console.log(response);
            if (response.error) {
                $('.submit-button').removeAttr("disabled");
                $(".payment-errors").html(response.error.message);
            } else {
                var form$ = $("#payment-form");
                var token = response['id'];
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                form$.get(0).submit();
            }
        }

        $(document).ready(function() {
            $("button.submit-button").click(function(event) {
                $('.submit-button').attr("disabled", "disabled");
                Stripe.createToken({
                    number: $('#card_number').val(),
                    exp_month: $('#exp_year').val(),
                    exp_year: $('#exp_month').val(),
                    cvc: $('#cvc').val(),
                    currency: 'usdasxas'
                }, stripeResponseHandler);
                return false;
            });
        });


    </script>
@endsection