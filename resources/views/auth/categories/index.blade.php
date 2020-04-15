@extends('auth.layouts.master')

@section('title', 'Список категорий')

@section('content')
    <div class="col-md-12">
        <h1>Категории</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->code}}</td>
                    <td>{{$category->name}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{route('categories.destroy', $category)}}" method="post">
                                <a href="{{route('categories.show', $category)}}" class="btn btn-success" type="button">Открыть</a>
                                <a href="{{route('categories.edit', $category)}}" class="btn btn-warning" type="button">Редактировать</a>
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
        {{$categories->links()}}
        <a href="{{route('categories.create')}}" type="button" class="btn btn-primary">Дбавить категорию</a>
    </div>
@endsection
