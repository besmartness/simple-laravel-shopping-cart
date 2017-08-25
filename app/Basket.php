<?php

namespace App;

use Illuminate\Notifications\Notifiable;

class Basket{

    public $items = null;
    public $totalQTY = 0;
    public $totalprice = 0;

    public function __construct($oldCart)
    {

        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQTY = $oldCart->totalQTY;
            $this->totalprice = $oldCart->totalprice;

        }
    }


    public function add($item, $id)
    {

        $storeditem = ['qty' => 0, 'price' => $item->price, 'item' => $item];

        if($this->items)
        {
            if(array_key_exists($id, $this->items))
            {
                $storeditem = $this->items[$id];
            }
        }
        $storeditem['qty'] ++;
        $storeditem['price'] = $item['price'] * $storeditem['qty'];
        $this->items['id'] = $storeditem;
        $this->totalQTY++;
        $this->totalprice += $item->price;

    }

}