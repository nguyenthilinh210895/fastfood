<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;

class ClientController extends Controller
{
	public function getIndex(){
		$food = Product::join('category', 'category.id', 'product.id_category')
						->where('category.type', 'Đồ Ăn')
						->paginate(8);
		$drink = Product::join('category', 'category.id', 'product.id_category')
						->where('category.type', 'Đồ Uống')
						->paginate(8);
		return view('client.index', compact('food', 'drink'));
	}
}
