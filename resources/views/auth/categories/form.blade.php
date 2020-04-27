@extends('auth.layouts.master')

@isset($category)
    @section('title', 'Редактирвать категорию' . $category->name)
@else
    @section('title', 'Создать категорию')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($category)
            <h1>Редактирвать категорию <b>{{$category->name}}</b></h1>
        @else
            <h1>Добавить категорию</h1>
        @endisset

        <form method="post" enctype="multipart/form-data"
              @isset($category)
              action="{{route('categories.update', $category)}}"
              @else
              action="{{route('categories.store')}}"
              @endisset
        >
            @isset($category)
                @method('PUT')
            @endisset
            @csrf
            <div>
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @error('code')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <input type="text" class="form-control" name="code" id="code"
                               value="{{old('code', isset($category) ? $category->code : null)}}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Наименование: </label>
                    <div class="col-sm-6">
                        @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{old('name', isset($category) ? $category->name : null)}}">
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
                               value="{{old('name_en', isset($category) ? $category->name_en : null)}}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @error('description')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <textarea type="text" class="form-control" name="description" id="description" cols="72" rows="7"
                        >{{old('description', isset($category) ? $category->description : null)}}</textarea>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description_en" class="col-sm-2 col-form-label">Описание en: </label>
                    <div class="col-sm-6">
                        @error('description_en')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <textarea type="text" class="form-control" name="description_en" id="description_en" cols="72" rows="7"
                        >{{old('description', isset($category) ? $category->description_en : null)}}</textarea>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Избражение: </label>
                    <div class="col-sm-10">
                        @error('image')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <label class="btn btn-default btn-file">Загрузить
                            <input type="file" style="display: none" name="image" id="image">
                        </label>
                    </div>
                </div>
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

