<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Category;
use App\Product;
use App\Table;

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
		return view('admin.page.index');
	}

    // list staff
	public function getListStaff(){
		$staff = User::where('delete_flag', 0)->get();
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

    //list table
    public function getListTable(){
    	$table = Table::where('delete_flag', 0)->get();
    	return view('admin.table.list', compact('table'));
    }

    // add product
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
    	return redirect()->back()->with('message', 'Đã Xóa');
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
}
