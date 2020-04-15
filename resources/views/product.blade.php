@extends('layouts.master')

@section('title', 'Товар')

@section('content')
    <h1>{{$product}}</h1>
{{--    <h2>{{ $product->category->name }}</h2>--}}
    <p>Цена: <b>{{$product->price}}</b></p>
    <img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg">
    <p>{{$product->description}}</p>

    <form action="http://internet-shop.tmweb.ru/basket/add/1" method="POST">
        <button type="submit" class="btn btn-success" role="button">Добавить в корзину</button>

        <input type="hidden" name="_token" value="hY1aIMZmpGYlcY91HvET5P8FtYvp8SgHz6KSgw69">
    </form>
@endsection
