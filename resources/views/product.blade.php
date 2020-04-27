@extends('layouts.master')

@section('title', __('main.product'))

@section('content')
    <h1>{{$skus->product->__('name')}}</h1>
    <h2>{{ $skus->product->category->__('name') }}</h2>
    <p>@lang('product.price'): <b>{{$skus->price}} {{ $currencySymbol }}</b></p>

    @isset($skus->product->properties)
        @foreach($skus->propertyOptions as $propertyOption)
            <h4>{{ $propertyOption->property->__('name') }}: {{ $propertyOption->__('name') }}</h4>
        @endforeach
    @endisset

    <img src="{{Storage::url($skus->product->image)}}">
    <p>{{$skus->product->__('description')}}</p>

    @if($skus->isAvailable())
        <form action="{{ route('basket-add', $skus->product) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success" role="button">@lang('product.add_to_cart')</button>
        </form>
    @else
        <span>@lang('product.not_available')</span>
        <br>
        <span>@lang('product.tell_me'):</span>
        <div class="warning">
            @if($errors->get('email'))
                {!! $errors->get('email')[0] !!}
            @endif
        </div>
        <form action="{{route('subscription', $skus)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="control-label col-lg-offset-3 col-lg-1">Email: </label>
                <div class="col-lg-4">
                    <input type="text" name="email" id="email" value="" class="form-control">
                </div>
            </div>
            <div class="col-lg-1">
                <button class="btn btn-success" type="submit">@lang('product.subscribe')</button>
            </div>
        </form>
    @endif

@endsection
