<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Category;
use App\Product;
use App\Table;
use App\BookTable;
use App\Order;
use App\OrderDetails;
use App\Receive;
use App\TimeKeeping;
use Carbon\Carbon;
use DB;

class AdminController extends Controller
{
	public function getLogin(){
		return view('admin.login');
	}

	public function postLogin(Request $request)
	{
		$this->validate(
			$request,
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

		$user = array('email' => $request->email, 'password' => $request->password);

		if (Auth::attempt($user)) {
			return redirect('/admin/index');
		} 
		else {
			return redirect('/admin/login')->with('message', 'Tài khoản hoặc mật khẩu không chính xác.');
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect('/admin/login');
	}

	public function getIndex(){
		// $now = Carbon::now();
		// $dates = [];
		// for($i=1; $i < $now->daysInMonth + 1; ++$i) {
		// 	$dates[] = Carbon::createFromDate($now->year, $now->month, $i)->format('m-d');
		// }

		$days = 30;
		$range = Carbon::now()->subDays($days);
		$data = DB::table('order')
		->where('created_at', '>=', $range)
		->groupBy('date')
		->orderBy('date', 'ASC')
		->get([
			DB::raw('Date(created_at) as date'),
			DB::raw('SUM(total_price) as totalPrice')
		])->toJson();
		// dd($data);
		return view('admin.page.index', compact('data'));
	}

	public function getSearchStatistical(Request $req){
		$start = Carbon::createFromFormat('Y-m-d', $req->start_date);
		$end = Carbon::createFromFormat('Y-m-d', $req->end_date);
		$data = DB::table('order')
		->where('created_at', '>=', $start)
		->where('created_at', '<=', $end)
		->groupBy('date')
		->orderBy('date', 'ASC')
		->get([
			DB::raw('Date(created_at) as date'),
			DB::raw('SUM(total_price) as totalPrice')
		])->toJson();
		// dd($data);
		return view('admin.page.index', compact('data'));
	}

    // list staff
	public function getListStaff(){
		$staff = User::where('delete_flag', 0)
		->where('role', '<>', 0)->get();		
		return view('admin.staff.list', compact('staff'));
	}

    //add staff
	public function getAddStaff(){
		return view('admin.staff.add');
	}

	public function postAddStaff(Request $req){
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

		if($req->password != $req->re_pasword){
			return redirect()->back()->with('error', 'Mật khẩu nhập lại không khớp.');
		}
		try {
			$staff = new User();
			$staff->name = $req->name;
			$staff->email = $req->email;
			$staff->password = \Hash::make($req->password);
			$staff->phone = $req->phone;
			$staff->address = $req->address;
			$staff->salary = $req->salary;
			$staff->avatar = "avatar.png";
			$staff->role = $req->role;
			$staff->start_in = $req->start_in;
			$staff->start_out = $req->start_out;
			$staff->save();
			return redirect()->back()->with('message', 'Thêm thành công.');
		} catch (Exception $e) {
			return redirect()->back()->with('error', 'Có lỗi hệ thống vui lòng thử lại.');
		}
	}

    //edit staff 
	public function getEditStaff($id){
		$staff = User::where('id', $id)->first();
		return view('admin.staff.edit', compact('staff'));
	}

	public function postEditStaff($id, Request $req){

		if($req->password != $req->re_pasword){
			return redirect()->back()->with('error', 'Mật khẩu nhập lại không khớp.');
		}
		try {
			$staff = User::where('id', $id)->first();
			$staff->name = $req->name;
			if($req->password != null){
				$staff->password = \Hash::make($req->password);
			}
			$staff->phone = $req->phone;
			$staff->address = $req->address;
			$staff->start_in = $req->start_in;
			$staff->start_out = $req->start_out;
			$staff->salary = $req->salary;
			$staff->role = $req->role;
			$staff->save();
			return redirect()->back()->with('message', 'Sửa thành công.');
		} catch (Exception $e) {
			return redirect()->back()->with('error', 'Có lỗi hệ thống vui lòng thử lại.');
		}
	}

    // delete staff
	public function getDeleteStaff($id){
		$staff = User::where('id', $id)->first();
		$staff->delete_flag = 1;
		$staff->save();
		return redirect()->back()->with('message', 'Xóa Thành Công');
	}

	//list product
	public function getListProduct(){
		$category = Category::where('delete_flag', 0)->get();
		$product = Product::where('delete_flag', 0)->get();
		return view('admin.product.list', compact('category', 'product'));
	}

	// add category
	public function postAddCategory(Request $req){
		$category = new Category();
		$category->name = $req->name;
		$category->type = $req->type;
		$category->save();
		return redirect()->back()->with('message', ' Thêm Loại Hàng Thành Công');
	}

	public function getDeleteCategory($id){
		$category = Category::where('id', $id)->first();
		$category->delete_flag = 1;
		$category->save();
		return redirect()->back()->with('message', 'Đã Xóa');
	}

    // add product
	public function getAddProduct(Request $req){
		$product = new Product();
		$product->product_name = $req->product_name;
		$product->id_category = $req->id_category;
		$product->unit_price = $req->unit_price;
		if($req->promotion_price != null){
			$product->promotion_price = $req->promotion_price;
		}
		if($req->hasFile('image')){
			$file = $req->file('image');
			$duoi = $file->getClientOriginalExtension();
			if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
			{
				return redirect()->back()->with('message', 'File ảnh không đúng định dạng');
			}
			$name = $file->getClientOriginalName();
			$image = str_random(5)."_".$name;
			while(file_exists("img/".$image))
			{   
				$image = str_random(5)."_".$name;
			}
			$file->move('img/', $image);    
			$product->image = $image;
		}
		$product->unit = $req->unit;
		$product->description = $req->description;
		$product->save();
		return redirect()->back()->with('message', ' Thêm Sản Phẩm Thành Công');
	}

	public function getDeleteProduct($id){
		$product = Product::where('id', $id)->first();
		$product->delete_flag = 1;
		$product->save();
		return redirect()->back()->with('message', 'Đã Xóa');
	}

    //edit staff 
	public function getEditProduct($id){
		$category = Category::where('delete_flag', 0)->get();
		$product = Product::where('id', $id)->first();
		return view('admin.product.edit', compact('product', 'category'));
	}

	public function postEditProduct($id, Request $req){
		$product = Product::find($id);
		$product->product_name = $req->product_name;
		$product->id_category = $req->id_category;
		$product->unit_price = $req->unit_price;
		if($req->promotion_price != null){
			$product->promotion_price = $req->promotion_price;
		}
		if($req->hasFile('image')){
			$file = $req->file('image');
			$duoi = $file->getClientOriginalExtension();
			if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
			{
				return redirect()->back()->with('message', 'File ảnh không đúng định dạng');
			}
			$name = $file->getClientOriginalName();
			$image = str_random(5)."_".$name;
			while(file_exists("img/".$image))
			{   
				$image = str_random(5)."_".$name;
			}
			$file->move('img/', $image);    
			$product->image = $image;
		}
		else{
			$product->image = $product->image;
		}
		$product->unit = $req->unit;
		$product->description = $req->description;
		$product->save();
		return redirect()->back()->with('message', ' Cập nhật Thành Công');
	}

    //list table
	public function getListTable(){
		$table = Table::where('delete_flag', 0)->get();
		return view('admin.table.list', compact('table'));
	}

    // add table
	public function getAddTable(Request $req){
		$table = new Table();
		$table->table_name = $req->table_name;
		$table->code = $req->code;
		$table->status = 0;
		$table->delete_flag = 0;
		$table->save();
		return redirect()->back()->with('message', ' Thêm Thành Công');
	}

	public function getDeleteTable($id){
		$table = Table::where('id', $id)->first();
		$table->delete_flag = 1;
		$table->save();
		return redirect('/admin/table/list')->with('message', 'Đã Xóa');
	}

	public function getOnTable($id){
		$table = Table::where('id', $id)->first();
		$table->status = 1;
		$table->save();
		return redirect()->back()->with('message', 'Đã đặt');
	}

	public function getOffTable($id){
		$table = Table::where('id', $id)->first();
		$table->status = 0;
		$table->save();
		return redirect()->back()->with('message', 'Đã hủy');
	}

	//edit table 
	public function getEditTable($id){
		$table = Table::where('id', $id)->first();
		return view('admin.table.edit', compact('table'));
	}

	public function postEditTable($id, Request $req){
		$table = Table::where('id', $id)->first();
		$table->table_name = $req->table_name;
		$table->code = $req->code;
		$table->status = 0;
		$table->delete_flag = 0;
		$table->save();
		return redirect('/admin/table/list')->with('message', 'Sửa thành công.');
	}

	public function getListBookTable(){
		$bookTable = BookTable::orderBy('created_at', 'desc')->get();
		return view('admin.table.booktable', compact('bookTable'));
	}

	public function getAcceptBookTable($id){
		$bookTable = BookTable::find($id);
		$bookTable->status = 1;
		$bookTable->save();
		return redirect()->back()->with('message', 'Đã Duyệt');
	}

	public function getCancelBookTable($id){
		$bookTable = BookTable::find($id);
		$bookTable->status = 2;
		$bookTable->save();

		$table = Table::find($bookTable->id_table);
		$table->status = 0;
		$table->save();
		return redirect()->back()->with('error', 'Đã Hủy');
	}
	//list order
	public function getListOrder(){
		$order = Order::where('delete_flag', 0)
						->orderBy('status', 'asc')
						->orderBy('created_at', 'desc')->get();
		return view('admin.order.list', compact('order'));
	}

	public function getAcceptOrder($id){
		$order = Order::where('id', $id)->first();
		$order->status = 1;
		$order->status_staff = 1;
		$order->id_staff = Auth::user()->id;
		$order->save();
		return redirect('/admin/order/list')->with('message', 'Đã duyệt');
	}

	public function getCancelOrder($id){
		$order = Order::where('id', $id)->first();
		$order->status = 0;
		$order->status_staff = 2;
		$order->id_staff = Auth::user()->id;
		$order->save();
		return redirect('/admin/order/list')->with('message', 'Đã Hủy');
	}

	// view order
	public function getViewOrder($id){
		$order = Order::where('id', $id)->first();
		$order_details = OrderDetails::where('id_order',$id)->get();
		return view('admin.order.view', compact('order', 'order_details'));
	}

	// Receive
	public function getListReceive(){
		$receive = Receive::orderBy('day', 'desc')->get();
		return view('admin.receive.list', compact('receive'));
	}

	public function getDeleteReceive($id){
		$receive = Receive::find($id);
		$receive->delete();
		return redirect()->back()->with('error', 'Đã Xóa');
	}

	public function postAddReceive(Request $req){
		$receive = new Receive();
		$receive->name = $req->name;
		$receive->unit = $req->unit;
		$receive->price = $req->unit_price;
		$receive->total_price = $req->total_price;
		$receive->day = $req->day;
		$receive->save();
		return redirect()->back()->with('message', 'Đã Nhập');
	}

	// time keeping
	public function getListTimeKeeping(){
		$time = TimeKeeping::orderBy('date', 'desc')->get();
		$staff = User::where('role', 2)
					->where('delete_flag', 0)
					->get();
		return view('admin.timekeeping.list', compact('time', 'staff'));
	}

	public function getDeleteTimeKeeping($id){
		$time = TimeKeeping::find($id);
		$time->delete();
		return redirect()->back()->with('error', 'Đã Xóa');
	}

	public function postAddTimeKeeping(Request $req){
		$time = new TimeKeeping();
		$time->date = $req->date;
		$time->id_staff_absent = $req->staff_absent;
		$time->id_staff_replace = $req->staff_replace;
		$time->save();
		return redirect()->back()->with('message', 'Đã Nhập');
	}
}
