<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

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

}
