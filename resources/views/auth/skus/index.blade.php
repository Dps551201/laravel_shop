@extends('auth.layouts.master')

@section('title', 'Товарные предложения')

@section('content')
    <div class="col-md-12">
        <h1>Товарные предложения</h1>
        <h2>{{$product->name}}</h2>
        <table class="table">
            <tbody>
            <tr>
                <th>#</th>
                <th>Товарное предложение (свойства)</th>
                <th>Действия</th>
            </tr>
            @foreach($skus as $sku)
                <tr>
                    <td>{{$sku->id}}</td>
                    <td>{{$sku->propertyOptions->map->name->implode(', ')}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{route('skus.destroy', [$product, $sku])}}" method="post">
                                <a href="{{route('skus.show', [$product, $sku])}}" class="btn btn-info" type="button">Открыть</a>
                                <a href="{{route('skus.edit', [$product, $sku])}}" class="btn btn-warning" type="button">Редактировать</a>
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
        {{$skus->links()}}
        <a href="{{route('skus.create', $product)}}" type="button" class="btn btn-primary">Добавить sku</a>
    </div>
@endsection
