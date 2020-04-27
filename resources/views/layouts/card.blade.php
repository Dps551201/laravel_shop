<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="labels">
            @if($sku->product->isNew())
                <span class="badge badge-success">@lang('main.properties.new')</span>
            @endif
            @if($sku->product->isRecommend())
                <span class="badge badge-warning">@lang('main.properties.recommend')</span>
            @endif
            @if($sku->product->isHit())
                <span class="badge badge-danger">@lang('main.properties.hit')</span>
            @endif
        </div>
        <img src="{{Storage::url($sku->product->image)}}" alt="{{$sku->product->__('name')}}">
        <div class="caption">
            <h3>{{$sku->product->__('name')}}</h3>
            @isset($sku->product->properties)
                @foreach($sku->propertyOptions as $propertyOption)
                    <h4>{{ $propertyOption->property->__('name') }}: {{$propertyOption->__('name')}}</h4>
                @endforeach
            @endisset
            <div>{{$sku->price}} {{$currencySymbol}}</div>
            <div>
                <form action="{{ route('basket-add', $sku) }}" method="post">
                    @csrf
                    @if($sku->isAvailable())
                        <button type="submit" class="btn btn-primary" role="button">@lang('main.add_to_basket')</button>
                    @else
                        @lang('main.not_available')
                    @endif
                    <a href="{{route('sku',
                         [isset($category) ? $category->code :
                         $sku->product->category->code, $sku->product->code, $sku->id])}}"
                       class="btn btn-default"
                       role="button">@lang('main.more')</a>
                </form>
            </div>
        </div>
    </div>
</div>
