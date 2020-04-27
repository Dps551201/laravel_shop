@extends('auth.layouts.master')

@section('title', 'Список товаров')

@section('content')
    <div class="col-md-12">
        <h1>Товары</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Кол-во товарных предложений</th>
                <th>Действия</th>
            </tr>
            @foreach($products as $product)
                <tr @if($product->deleted_at) style="background-color: #ccc;" @endif>
                    <td>{{$product->id}}</td>
                    <td>{{$product->code}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category->name}}</td>
                    <td></td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{route('products.destroy', $product)}}" method="post">
                                <a href="{{route('products.show', $product)}}" class="btn btn-info" type="button">Открыть</a>
                                <a href="{{route('skus.index', $product)}}" class="btn btn-primary" type="button">Skus</a>
                                <a href="{{route('products.edit', $product)}}" class="btn btn-warning" type="button">Редактировать</a>
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Удалить</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$products->links()}}
        <a href="{{route('products.create')}}" type="button" class="btn btn-primary">Дбавить товар</a>
    </div>
@endsection
