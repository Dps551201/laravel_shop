<?php

namespace App\Models;

use App\Mail\SendSubscriptionMessageMail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subscription extends Model
{
    protected $fillable = [
        'email', 'sku_id'
    ];

    public function scopeActiveBySkuId($query, $skuId)
    {
        return $query->where('status', 0)->where('sku_id', $skuId);
    }

    public function sku()
    {
        return $this->belongsTo(Sku::class);
    }

    public static function sendEmailsBySubscription(Sku $skus)
    {
        $subscriptions = self::activeBySkuId($skus->id)->get();

        foreach($subscriptions as $subscription) {
            Mail::to($subscription->email)->send(new SendSubscriptionMessageMail($skus));
            $subscription->status = 1;
            $subscription->save();
        }

    }
}
