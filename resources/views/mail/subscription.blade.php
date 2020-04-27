<p>@lang('mail.subscription.dear_client') {{ $sku->product->__('name') }} @lang('mail.subscription.appeared_in_stock')</p>

<a href="{{route('sku', [$sku->product->category->code, $sku->product->code, $sku->id])}}">@lang('mail.subscription.more_info')</a>


