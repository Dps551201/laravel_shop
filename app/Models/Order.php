<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function calculateFullAmount()
    {
        $amount = 0;
        foreach($this->products as $product) {
            $amount += $product->getPriceForCount();
        }
        return $amount;
    }

    public static function eraseOrderAmount()
    {
        session()->forget('full_order_amount');
    }

    public static function changeFullAmount($changeAmount)
    {
        $amount = self::getFullAmount() + $changeAmount;
        session(['full_order_amount' => $amount]);
    }

    public static function getFullAmount()
    {
        return session('full_order_amount', 0);
    }

    public function saveOrder($name, $phone)
    {
        if ($this->status == 0) {
            $this->name = $name;
            $this->phone = $phone;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');
            return true;
        } else {
            return false;
        }
    }
}
