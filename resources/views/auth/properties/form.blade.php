@extends('auth.layouts.master')

@isset($property)
    @section('title', 'Редактирвать свойство' . $property->name)
@else
    @section('title', 'Создать свойство')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($property)
            <h1>Редактирвать свойство <b>{{$property->name}}</b></h1>
        @else
            <h1>Добавить свойство</h1>
        @endisset

        <form method="post" enctype="multipart/form-data"
              @isset($property)
              action="{{route('properties.update', $property)}}"
              @else
              action="{{route('properties.store')}}"
              @endisset
        >
            @isset($property)
                @method('PUT')
            @endisset
            @csrf
            <div>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Наименование: </label>
                    <div class="col-sm-6">
                        @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{old('name', isset($property) ? $property->name : null)}}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name_en" class="col-sm-2 col-form-label">Наименование en: </label>
                    <div class="col-sm-6">
                        @error('name_en')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <input type="text" class="form-control" name="name_en" id="name_en"
                               value="{{old('name_en', isset($property) ? $property->name_en : null)}}">
                    </div>
                </div>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

