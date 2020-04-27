<?php

namespace App\Observers;

use App\Models\Sku;
use App\Models\Subscription;

class SkuObserver
{
    public function updating(Sku $skus)
    {
        $oldCount = $skus->getOriginal('count');

        if ($oldCount == 0 && $skus->count > 0) {
            Subscription::sendEmailsBySubscription($skus);
        }
    }
}
