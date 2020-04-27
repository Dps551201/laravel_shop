<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'amount', 'currency_id'];

    public function skus()
    {
        return $this->belongsToMany(Sku::class)->withPivot('count', 'price')->withTimestamps();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function calculateFullAmount()
    {
        $amount = 0;
        $skus = $this->skus()->withTrashed()->get();

        foreach($skus as $sku) {
            $amount += $sku->getPriceForCount();
        }
        return $amount;
    }

    public function getFullAmount()
    {
        $amount = 0;
        foreach ($this->skus as $sku) {
            $amount += $sku->price * $sku->countInOrder;
        }

        return $amount;
    }

    public function saveOrder($name, $phone)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->status = 1;
        $this->amount = $this->getFullAmount();

        $skus = $this->skus;
        $this->save();

        foreach($skus as $skuInOrder) {
            $this->skus()->attach($skuInOrder, [
                'count' => $skuInOrder->countInOrder,
                'price' => $skuInOrder->price,
            ]);
        }

        session()->forget('order');
        return true;
    }
}
