<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Cart;
use Session;

class AjaxController extends Controller
{
    public function getCountOrder(){
        $countOrder = Order::where('status_staff', 0)->count('id');
        return response()->json(array('countOrder'=> $countOrder), 200);
    }

    public function getAddToCard(Request $req){
        $productId = $req->productId;
        $product = Product::find($productId);
		$oldCart = Session('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->add($product, $productId);
        $req->Session()->put('cart', $cart);
        $productCart = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQty = $cart->totalQty;
        echo "<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">Giỏ hàng <span class=\"badge\">" . $totalQty . "</span> <span class=\"caret\"></span></a>" ;
        echo "<ul class=\"dropdown-menu\" role=\"menu\">";
        foreach($productCart as $product){
            echo "<li style=\"width: 250px\">";
            echo "<div class=\"item\">";
            echo "<div class=\"item-left\">";
            echo "<div style=\"float: left;\">";
            echo "<img src=\"img/". $product['item']['image'] . "\" alt=\"\" width=\"50\" />";
            echo "</div>";
            echo "<div class=\"item-info\" style=\"float: left; padding-left: 10px;\">";
            echo "<b>" . $product['item']['product_name'] . "</b>";
            echo "<p>" . $product['qty'] .  "*" ;
            if($product['item']['promotion_price']!=0){
                echo number_format($product['item']['promotion_price']) ." VNĐ";
            }else{
                echo number_format($product['item']['unit_price']) . "VNĐ";
            }
            echo "</p>";
            echo "</div>";
            echo "<div style=\"float: right;\"><a href=\"/del-cart/" . $product['item']['id'] . "\" class=\"btn btn-xs btn-danger pull-right\">x</a></div>";
            echo "</div></div></li>";
        }
        echo "<div><p style=\"margin-left: 10px;\"> Tổng Tiền:" . number_format($totalPrice) .  "VNĐ <a href=\"/cart\" class=\"btn btn-primary\">Xem giỏ hàng</a></p></div></ul>";
    }
}
