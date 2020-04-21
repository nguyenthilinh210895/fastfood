<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id){
		$price = 0;
		if($item->promotion_price != null){
			$price = $item->promotion_price;
		}else{
			$price = $item->unit_price;
		}
		$cart = ['qty'=>0, 'price' => $price, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$cart = $this->items[$id];
			}
		}
		$cart['qty']++;
		$cart['price'] = $price * $cart['qty'];
		$this->items[$id] = $cart;
		$this->totalQty++;
		$this->totalPrice += $price;
	}

	// add multi
	public function addMulti($item, $id, $unit){
		$price = 0;
		if($item->promotion_price != null){
			$price = $item->promotion_price * $unit;
		}else{
			$price = $item->unit_price * $unit;
		}
		$cart = ['qty'=>0, 'price' => $price, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$cart = $this->items[$id];
			}
		}
		$cart['qty'] = $unit;
		$cart['price'] = $price;
		$this->items[$id] = $cart;
		$this->totalQty += $unit;
		$this->totalPrice += $price;
	}

	// update
	public function update($item, $id, $unit){
		//delete item
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);

		//update item
		$price = 0;
		if($item->promotion_price != null){
			$price = $item->promotion_price * $unit;
		}else{
			$price = $item->unit_price * $unit;
		}
		$cart = ['qty'=>0, 'price' => $price, 'item' => $item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$cart = $this->items[$id];
			}
		}
		$cart['qty'] = $unit;
		$cart['price'] = $price;
		$this->items[$id] = $cart;
		$this->totalQty += $unit;
		$this->totalPrice += $price;
	}

	//delete 1
	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->items[$id]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -= $this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//delete nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
