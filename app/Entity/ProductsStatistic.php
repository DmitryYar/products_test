<?php

namespace App\Entity;


class ProductsStatistic
{
    public $qty = 0;
    public $totalPrice = 0;
    public $totalDiscount = 0;

    public $totalAmount = 0;
    public $amountDiscount = 0;
    public $totalAmountWithDiscount = 0;

    public function calc(float $price, float $qty, float $discount)
    {
        $this->addPrice($price);
        $this->addQty($qty);
        $this->addTotal($price, $qty);
        $this->addDiscount($discount);
        $this->addAmountDiscount($discount, $qty);
        $this->countTotalAmountWithDiscount($this->totalAmount, $this->amountDiscount);
    }

    private function addPrice(float $price)
    {
        $this->totalPrice += $price;
    }

    public function addQty(float $qty)
    {
        $this->qty += $qty;
    }

    public function addTotal(float $price, float $qty)
    {
        $this->totalAmount += $price * $qty;
    }

    public function addDiscount(float $discount)
    {
        $this->totalDiscount += $discount;
    }
    
    public function addAmountDiscount(float $discount, float $qty)
    {
        $this->amountDiscount += $discount * $qty;
    }

    public function countTotalAmountWithDiscount($totalAmount, $totalDiscount)
    {
        $this->totalAmountWithDiscount = $totalAmount - $totalDiscount;
    }
}
