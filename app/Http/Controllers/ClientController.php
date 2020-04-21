<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\product;
use App\User;
use App\Category;
use App\Comment;
use App\Cart;
use App\Checkout;
use App\Customer;
use App\Order;
use App\OrderDetails;
use App\Table;
use App\BookTable;
use Session;
use DB;
use Carbon\Carbon;

class ClientController extends Controller
{
	public function getIndex(){
		$food = Product::join('category', 'category.id', 'product.id_category')
		->select('product.*')
		->where('category.type', 'Đồ Ăn')
		->paginate(8, ['*'], 'food');
		$drink = Product::join('category', 'category.id', 'product.id_category')
		->select('product.*')
		->where('category.type', 'Đồ Uống')
		->paginate(8, ['*'], 'drink');
		return view('client.index', compact('food', 'drink'));
	}

	//Login
	public function getLogin(){
		return view('client.login');
	}

	public function postLogin(Request $req){
		$this->validate(
			$req,
			[
				'email' => 'required',
				'password' => 'required|min:6',

			],
			[
				'email.required' => 'Vui lòng nhập Tài Khoản',
				'email.required' => 'Vui lòng nhập mật khẩu',
				'password.min' => 'Mật khẩu có ít nhất 6 ký tự',
			]
		);

		$user = array('email' => $req->email, 'password' => $req->password, 'role' => 0);

		if (Auth::attempt($user)) {
			if($req->reg == 0){
				return redirect('/');
			}
			else{
				return redirect()->back();
			}
		} 
		else {
			return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không chính xác.');
		}
	}

	public function getLogout(){
		Auth::logout();
		return redirect('/');
	}

	public function postRegister(Request $req){
		$this->validate(
			$req,
			[
				'email' => 'unique:users,email',
				'password' => 'required|min:6|regex:(^[A-Za-z0-9_.]+$)',
			],
			[
				'email.unique' => 'Email đã tồn tại',
				'password.required' => 'Vui lòng nhập mật khẩu',
				'password.min' => 'Mật khẩu có ít nhất 6 ký tự',
				'password.regex' => 'Đăng Ký Thất Bại. Mật Khẩu Chứa Ký Tự Không Hợp Lệ',
			]
		);

		if($req->password != $req->re_password){
			return redirect()->back()->with('error', 'Mật khẩu nhập lại không khớp.');
		}
		try {
			$user = new User();
			$user->name = $req->name;
			$user->email = $req->email;
			$user->password = \Hash::make($req->password);
			$user->phone = $req->phone;
			$user->address = $req->address;
			$user->avatar = "avatar.png";
			$user->role = 0;
			$user->save();
			return redirect()->back()->with('message', 'Đăng Ký thành công.');
		} catch (Exception $e) {
			return redirect()->back()->with('error', 'Có lỗi hệ thống vui lòng thử lại.');
		}
	}

	//product details
	public function getProductDetails($id){
		$product = Product::where('id', $id)->first();
		$relate_product = Product::where('id_category', $product->id_category)
		->where('delete_flag', 0)->paginate(4);
		$category = Category::orderBy('created_at', 'desc')->take(20)->get();
		$comment = Comment::where('id_product', $id)
		->where('delete_flag', 0)
		->get();
		return view('client.product.details', compact('product', 'relate_product', 'category', 'comment'));
	}

	//commment
	public function postComment($id, Request $req){
		$comment = new Comment();
		$comment->content = $req->content;
		$comment->id_product = $id;
		$comment->id_user = Auth::user()->id;
		$comment->rate = 5;
		$comment->save();
		return redirect()->back()->with('message', 'Comment thành công');
	}

	//add to cart
	public function getAddtoCart(Request $req, $id){
        //check exits product in cart
		$product = Product::find($id);
		$oldCart = Session('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->add($product, $id);
		$req->Session()->put('cart', $cart);
		return redirect()->back();
	}

	//add mulitple to cart
	public function getAddMultipletoCart(Request $req, $id){
		$unit = $req->unit;
        //check exits product in cart
		$product = Product::find($id);
		$oldCart = Session('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->addMulti($product, $id, $unit);
		$req->Session()->put('cart', $cart);
		return redirect()->back();
	}

	//update to cart
	public function getUpdateCart(Request $req){
		$unit = $req->unit;
		$id = $req->id;
        //check exits product in cart
		$product = Product::find($id);
		$oldCart = Session('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->update($product, $id, $unit);
		$req->Session()->put('cart', $cart);
		return redirect()->back();
	}

	public function getDelItemCart($id){
		$oldCart = Session::has('cart')?Session::get('cart'):null;
		$cart = new Cart($oldCart);
		$cart->removeItem($id);
		if(count($cart->items)>0){
			Session::put('cart', $cart);
		}
		else{
			Session::forget('cart');
		}

		return redirect()->back();
	}

    //checkout
	public function getCart(){
		$category = Category::orderBy('created_at', 'desc')->take(10)->get();
		return view('client.cart', compact('category'));
	}

    //search product
	public function getsearchProduct(Request $req){
		$product = Product::where('product_name', 'LIKE', '%' .$req->key. '%')->paginate(6);
		$key = $req->key;
		$category = Category::orderBy('created_at', 'desc')->take(20)->get();
		return  view('client.product.search', compact('product', 'key', 'category'));
	}

    // product by category
	public function getProductByCategory($id){
		$product = Product::where('id_category', $id)->paginate(6);
		$category = Category::orderBy('created_at', 'desc')->take(20)->get();
		$key = Category::where('id', $id)->first();
		return  view('client.product.product-by-category', compact('product', 'key', 'category'));
	}

    // check out
	public function getCheckout(Request $req){
		$checkout = new Checkout();
		$checkout->total_price = $req->total_price;
		$checkout->book_type = $req->book_type;
		Session::put('checkout', $checkout);
		if($req->book_type == '1'){
			return view('client.checkout.online');
		}
		else{
			return view('client.checkout.offline');
		}
	}

    // accept order
	public function postAcceptOrderOnline(Request $req){
		$user = User::where('id', Auth::user()->id)->first();
		// transaction
		DB::beginTransaction();
		try {
			// save customer
			$customer = new Customer();
			$customer->name = $req->name;
			$customer->email = $req->email;
			$customer->phone = $req->phone;
			$customer->address = $req->address;
			$customer->note = $req->note;
			$customer->save();

			// save order
			$order = new Order();
			$order->total_price = Session::get('checkout')->total_price;
			if($req->payment == 1){
				$order->payment = 'Thanh Toán qua ngân lượng';
				$order->status = 1;
			}
			else{
				$order->payment = 'Thanh Toán khi nhận hàng';
				$order->status = 0;
			}
			$order->note = $req->note;
			$order->type_order = Session::get('checkout')->book_type;
			$order->delete_flag = 0;
			$order->id_customer = $customer->id;
			$order->save();

			$cart = Session::get('cart');
			foreach($cart->items as $key => $value){
				$orderDetails = new OrderDetails();
				$orderDetails->id_order = $order->id;
				$orderDetails->id_product = $key;
				$orderDetails->unit_price = $value['price']/$value['qty'];
				$orderDetails->quantity = $value['qty'];
				$orderDetails->save();
			}
			Session::forget('cart');
			Session::forget('checkout');
			DB::commit();
			return view('client.checkout.complete');
		}
		catch (Exception $e) {
            DB::rollBack();
            return redirect('/')->with('error', 'Có Lỗi Xảy Ra, Vui Lòng Thử Lại!');
        }
	}

	// sale off
	public function getSaleOff(){
		$product = Product::where('promotion_price', '<>', 'null')->paginate(6);
		$category = Category::orderBy('created_at', 'desc')->take(20)->get();
		return  view('client.product.saleoff', compact('product', 'category'));
	}

	// introduce
	public function getIntroduce(){
		$table = Table::where('delete_flag', 0)->get();
		return view('client.introduce', compact('table'));
	}

	// booktable
	public function postBookTable(Request $req){
		$table = Table::find($req->id);
		// transaction
		DB::beginTransaction();
		try {
			// save customer
			$customer = new Customer();
			$customer->name = $req->name;
			$customer->email = $req->email;
			$customer->phone = $req->phone;
			$customer->address = $table->table_name;
			$customer->note = $req->note;
			$customer->save();

			// save booktable
			$booktable = new BookTable();
			$booktable->note = $req->note;
			$booktable->id_customer = $customer->id;
			$booktable->id_table = $table->id;
			$booktable->status = 0;
			$booktable->save();

			//save table
			$table->status = 1;
			$table->save();

			DB::commit();
			return redirect('/introduce')->with('message', 'Đã đặt bàn, chúng tôi sẽ liên hệ lại với bạn sau ít phút');
		}
		catch (Exception $e) {
            DB::rollBack();
            return redirect('/')->with('error', 'Có Lỗi Xảy Ra, Vui Lòng Thử Lại!');
        }
	}
}
