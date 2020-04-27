@extends('auth.layouts.master')

@section('title', 'Свойства')

@section('content')
    <div class="col-md-12">
        <h1>Свойства</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            @foreach($properties as $property)
                <tr>
                    <td>{{$property->id}}</td>
                    <td>{{$property->name}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{route('properties.destroy', $property)}}" method="post">
                                <a href="{{route('properties.show', $property)}}" class="btn btn-success" type="button">Открыть</a>
                                <a href="{{route('properties.edit', $property)}}" class="btn btn-warning" type="button">Редактировать</a>
                                <a href="{{route('property-options.index', $property)}}" class="btn btn-primary" type="button">Значения свойства</a>
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
        {{$properties->links()}}
        <a href="{{route('properties.create')}}" type="button" class="btn btn-primary">Добавить свойство</a>
    </div>
@endsection
