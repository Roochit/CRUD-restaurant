<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\AdminModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller



{
    public function __construct()
{
    // ใช้ middleware 'auth:admin' เพื่อบังคับให้ต้องล็อกอินในฐานะ admin ก่อนใช้งาน controller นี้
     //ถ้าไม่ล็อกอินหรือไม่ได้ใช้ guard 'admin' จะถูก redirect ไปหน้า login
    $this->middleware('auth:admin');
    }


    public function index()
    {
        try {
            Paginator::useBootstrap();
            $adminList = AdminModel::orderBy('id', 'desc')->paginate(8); //order by & pagination
            return view('admin.list', compact('adminList'));
        } catch (\Exception $e) {
        //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
        // \Log::error('Admin list error: '.$e->getMessage());
            return view('errors.404');
        }
    }

    public function adding() {
        return view('admin.create');
    }

    public function create(Request $request)
    {
         //echo '<pre>';
         //dd($_POST);
         //exit();

        // vali msg 
        $messages = [
            'admin_name.required' => 'กรุณากรอกข้อมูล',
            'admin_name.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัวอักษร',
            'admin_name.unique' => 'ชื่อซ้ำ เพิ่มใหม่อีกครั้ง',

            'admin_username.required' => 'กรุณากรอกข้อมูล',
            'admin_username.email' => 'อีเมลไม่ถูกต้อง',
            'admin_username.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัวอักษร',
            'admin_username.unique' => 'ชื่อซ้ำ เพิ่มใหม่อีกครั้ง',

            
            'admin_password.required' => 'กรุณากรอกข้อมูล',
            'admin_password.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัวอักษร',
            
        ];

        //rule 
        $validator = Validator::make($request->all(), [
            'admin_name' => 'required|min:3',
            'admin_username' => 'required|min:3|unique:staff_accounts',
            'admin_password' => 'required|min:3',
        ], $messages);

        //check vali 
        if ($validator->fails()) {
            return redirect('admin/adding')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            //ปลอดภัย: กัน XSS ที่มาจาก <script>, <img onerror=...> ได้
            AdminModel::create([
                'admin_name' => strip_tags($request->input('admin_name')),
                'admin_username' => strip_tags($request->input('admin_username')),
                'admin_password' => bcrypt($request-> input('admin_password'))
            ]);
            // แสดง Alert ก่อน return
            
            return redirect('/admin');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun create



 public function edit($id)
    {
        try {
            //query data for form edit 
            $admin = AdminModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($admin)) {
                $id = $admin->id;
                $admin_name = $admin->admin_name;
                $admin_username = $admin->admin_username;
                

                return view('admin.edit', compact('id', 'admin_name' ,'admin_username'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func edit


 public function update($id, Request $request)
    {
        //echo '<pre>';
         //dd($_POST);
         //exit();

        //vali msg 
        $messages = [
            'admin_name.required' => 'กรุณากรอกข้อมูล',
            'admin_name.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัวอักษร',
            
            'admin_username.required' => 'กรุณากรอกข้อมูล',
            'admin_username.email' => 'อีเมลไม่ถูกต้อง',
            'admin_username.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัวอักษร',
            'admin_username.unique' => 'ชื่อซ้ำ เพิ่มใหม่อีกครั้ง',

            
            
        ];

        //rule
        $validator = Validator::make($request->all(), [
            'admin_username' => [
                    'required',
                    'min:3',
                        Rule::unique('staff_accounts', 'admin_username')->ignore($id, 'id'),
            ],
            'admin_name' => 'required|min:3',
    ], $messages);

    //check 
        if ($validator->fails()) {
            return redirect('admin/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $admin = AdminModel::find($id);
            $admin->update([
                    'admin_username' => strip_tags($request->input('admin_username')), //column update 
                    'admin_name' => strip_tags($request->input('admin_name')),
                ]);
            // แสดง Alert ก่อน return
            Alert::success('เปลี่ยนชื่อเสร็จเรียบร้อย');
            return redirect('/admin');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun update 


    public function remove($id)
    {
       // echo '<pre>';
         //dd($_POST);
         //exit();
       
         try {
            $admin = AdminModel::find($id);  //query หาว่ามีไอดีนี้อยู่จริงไหม 
            $admin->delete();
            Alert::success('[ข้อมูลถูกลบเรียบร้อย]');
            return redirect('/admin');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            //return view('errors.404');
        }
    } //remove 


     public function reset($id)
    {
        try {
            //query data for form edit 
            $admin = AdminModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404
            if (isset($admin)) {
                $id = $admin->id;
                $admin_name = $admin->admin_name;
                $admin_username = $admin->admin_username;
                

                return view('admin.editPassword', compact('id', 'admin_name' ,'admin_username'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //func reset

    public function resetPassword($id, Request $request)
    {
        //echo '<pre>';
         //dd($_POST);
         //exit();

        //vali msg 
        $messages = [
            'newPassword.required' => 'กรุณากรอกข้อมูล',
            'newPassword.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัวอักษร',
            'newPassword.same' => 'รหัสผ่านไม่ตรงกัน',  

            'confirmNewPassword.required' => 'กรุณากรอกข้อมูล',
            'confirmNewPassword.min' => 'กรอกข้อมูลขั้นต่ำ :min ตัวอักษร',

            
        ];

        //rule
        $validator = Validator::make($request->all(), [
            'newPassword' => 'required|min:3|same:confirmNewPassword',
            'confirmNewPassword' => 'required|min:3|same:confirmNewPassword',
                        
            
    ], $messages);

    //check 
        if ($validator->fails()) {
            return redirect('admin/reset/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $admin = AdminModel::find($id);
            //sql update :update   table set col ='aaaaa' where id=?
            $admin->update([
                    'admin_password' => bcrypt($request->input('newPassword')), //column update 
                    
                ]);
            // แสดง Alert ก่อน return
            Alert::success('Reset Password Successfully');
            return redirect('/admin');
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('errors.404');
        }
    } //fun update


} //class
