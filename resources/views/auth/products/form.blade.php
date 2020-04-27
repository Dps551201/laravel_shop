@extends('auth.layouts.master')

@isset($product)
    @section('title', 'Редактирвать товар' . $product->name)
@else
    @section('title', 'Создать товар')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($product)
            <h1>Редактирвать товар <b>{{$product->name}}</b></h1>
        @else
            <h1>Добавить товар</h1>
        @endisset
        <form method="post" enctype="multipart/form-data"
              @isset($product)
              action="{{route('products.update', $product)}}"
              @else
              action="{{route('products.store')}}"
              @endisset
        >
            @isset($product)
                @method('PUT')
            @endisset
            @csrf
            <div>
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'code'])
                        <input type="text" class="form-control" name="code" id="code"
                               value="{{old('code', isset($product) ? $product->code : null)}}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Наименование: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{old('name', isset($product) ? $product->name : null)}}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name_en" class="col-sm-2 col-form-label">Наименование en: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'name_en'])
                        <input type="text" class="form-control" name="name_en" id="name_en"
                               value="{{old('name_en', isset($product) ? $product->name_en : null)}}">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Категория товара: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'category_id'])
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                        @isset($product)
                                        @if($product->category_id == $category->id)
                                            selected
                                        @endif
                                        @endisset
                                >{{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'description'])
                        <textarea type="text" class="form-control" name="description" id="description" cols="72"
                                  rows="7">{{old('code', isset($product) ? $product->description : null)}}</textarea>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description_en" class="col-sm-2 col-form-label">Описание en: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' => 'description_en'])
                        <textarea type="text" class="form-control" name="description_en" id="description_en" cols="72"
                                  rows="7">{{old('code', isset($product) ? $product->description_en : null)}}</textarea>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Избражение: </label>
                    <div class="col-sm-10">
                        @include('auth.layouts.error', ['fieldName' => 'image'])
                        <label class="btn btn-default btn-file">Загрузить
                            <input type="file" style="display: none" name="image" id="image">
                        </label>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label for="property_id[]" class="col-sm-2 col-form-label">Свойства товара: </label>
                    <div class="col-sm-6">
                        @include('auth.layouts.error', ['fieldName' =>'property_id[]'])
                        <select name="property_id[]" multiple class="form-control" id="property_id[]">
                            @foreach($properties as $property)
                                <option value="{{$property->id}}"
                                    @isset($product)
                                        @if($product->properties->contains($property->id))
                                        selected
                                        @endif
                                    @endisset
                                >{{$property->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                @foreach([
                'hit' => 'Хит продаж',
                'new' => 'Новинка',
                'recommend' => 'Рекомендуемые',
                ] as $field => $title)
                    <div class="form-group row">
                        <label for="{{$field}}" class="col-sm-2 col-form-label">{{$title}}: </label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="{{$field}}" id="{{$field}}"
                            @if(isset($product) && $product->$field === 1)
                                checked="checked"
                            @endif
                            >
                        </div>
                    </div>
                @endforeach
                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

