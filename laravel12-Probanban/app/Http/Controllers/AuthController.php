<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{


public function index()
{
        return view('auth.login');
}


public function login(Request $request) {
         //vali msg
        $request->validate([
            'admin_username' => 'required|email|max:100',
            'admin_password' => 'required|string|min:3',
        ], [
            'admin_username.required' => 'กรุณากรอกข้อมูล',
            'admin_username.email' => 'รูปแบบอีเมลไม่ถูกต้อง',
            'admin_password.required' => 'กรุณากรอกข้อมูล',
            'admin_password.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัว',
        ]);

        //ตรวจสอบข้อมูลที่ส่งมา
        $credentials = $request->validate([
            'admin_username' => 'required',
            'admin_password' => 'required',
        ]);


  if (Auth::guard('admin')->attempt([
       // ตรวจสอบค่า username/password ที่ส่งมาจากฟอร์ม
       'admin_username' => $credentials['admin_username'],
       'password' => $credentials['admin_password'],
   ])) {
       // ถ้า login สำเร็จ
     
       // เพื่อความปลอดภัย Laravel จะสร้าง session ใหม่
       // ป้องกัน session fixation attack
       $request->session()->regenerate();

       // เก็บค่า admin_name ของคนที่ login สำเร็จ ลงใน session
       // เพื่อเรียกใช้ใน view เช่น {{ session('admin_name') }}
        session(['admin_name' => Auth::guard('admin')->user()->admin_name]);
        session(['admin_id' => Auth::guard('admin')->user()->id]);
     
       // หลัง login สำเร็จ ส่งผู้ใช้ไปที่ /dashboard
       // หรือถ้าก่อนหน้านี้ผู้ใช้กดลิงก์ไปหน้าที่ต้อง login ก่อน
       // Laravel จะพา redirect ไปหน้าที่ intended แทน
       return redirect()->intended('/dashboard');
   }
   

   return back()->withErrors([
       'admin_username' => 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง',
   ])->withInput();
    // คืนค่าข้อมูล input (เช่น admin_username) กลับไปที่ฟอร์ม
    // ทำให้เวลาผู้ใช้กรอกผิด รหัสผ่านไม่ถูก แต่ username ยังโชว์อยู่
    // จะได้ไม่ต้องกรอกใหม่

} //login


 public function logout(Request $request)
    {
        // ออกจากระบบผู้ใช้ปัจจุบัน
        Auth::logout();
        // ล้าง session ทั้งหมดของผู้ใช้เพื่อความปลอดภัย
        $request->session()->invalidate();
        // สร้าง CSRF token ใหม่ ป้องกันการโจมตีแบบ CSRF
        $request->session()->regenerateToken();
        // เปลี่ยนเส้นทางผู้ใช้ไปยังหน้าแรกหลัง logout
        return redirect('/');
    }


} //class
