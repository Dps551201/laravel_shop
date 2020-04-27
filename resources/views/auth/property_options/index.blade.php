@extends('auth.layouts.master')

@section('title', 'Варианты свойств')

@section('content')
    <div class="col-md-12">
        <h1>Варианты свойств</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>#</th>
                <th>Свойство</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            @foreach($propertyOptions as $propertyOption)
                <tr>
                    <td>{{$propertyOption->id}}</td>
                    <td>{{$property->name}}</td>
                    <td>{{$propertyOption->name}}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{route('property-options.destroy', [$property, $propertyOption])}}" method="post">
                                <a href="{{route('property-options.show', [$property, $propertyOption])}}" class="btn btn-success" type="button">Открыть</a>
                                <a href="{{route('property-options.edit', [$property, $propertyOption])}}" class="btn btn-warning" type="button">Редактировать</a>
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
        {{$propertyOptions->links()}}
        <a href="{{route('property-options.create', $property)}}" type="button" class="btn btn-primary">Добавить значение свойства</a>
    </div>
@endsection
