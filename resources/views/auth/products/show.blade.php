@extends('auth.layouts.master')

@section('title', 'Товар: ' . $product->name)

@section('content')
    <div class="col-md-12">
        <h1>Товар {{$product->name}}</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>Поле</th>
                <th>Значение</th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{$product->id}}</td>
            </tr>
            <tr>
                <td>Код</td>
                <td>{{$product->code}}</td>
            </tr>
            <tr>
                <td>Наименование</td>
                <td>{{$product->name}}</td>
            </tr>
            <tr>
                <td>Наименование en</td>
                <td>{{$product->name_en}}</td>
            </tr>
            <tr>
                <td>Описание</td>
                <td>{{$product->description}}</td>
            </tr>
            <tr>
                <td>Описание en</td>
                <td>{{$product->description_en}}</td>
            </tr>
            <tr>
                <td>Изображение</td>
                <td><img src="{{Storage::url($product->image)}}" alt="product_image" height="240px"></td>
            </tr>
            <tr>
                <td>Категория</td>
                <td>{{$product->category->name}}</td>
            </tr>
            <tr>
                <td>Лейблы</td>
                <td>
                    @if($product->isNew())
                        <span class="badge badge-success">Новинка</span>
                    @endif

                    @if($product->isRecommend())
                        <span class="badge badge-warning">Рекомендуем</span>
                    @endif

                    @if($product->isHit())
                        <span class="badge badge-danger">Хит продаж!</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Количество</td>
                <td>{{$product->count}}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection

