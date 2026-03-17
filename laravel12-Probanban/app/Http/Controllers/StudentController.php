<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use App\Models\StudentModel;

class StudentController extends Controller
{
    /* =======================
     *  LIST
     * ======================= */
    public function index()
    {
        Paginator::useBootstrap();
        $student = StudentModel::orderBy('id', 'desc')->paginate(5);
        return view('student.list', compact('student'));
    }

    /* =======================
     *  CREATE FORM
     * ======================= */
    public function adding()
    {
        return view('student.create');
    }

    /* =======================
     *  STORE
     * ======================= */
    public function create(Request $request)
    {
        $messages = [
            'std_name.required'  => 'กรุณากรอกชื่อ',
            'std_name.min'       => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'std_phone.required' => 'กรุณากรอกเบอร์โทร',
            'std_phone.min'      => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'std_code.required'  => 'ห้ามว่าง',
            'std_code.unique'    => 'รหัสนักศึกษานี้ถูกใช้แล้ว',

            'std_img.mimes'      => 'รองรับ jpeg, png, jpg เท่านั้น',
            'std_img.max'        => 'ขนาดไฟล์ไม่เกิน 5MB',
        ];

        $validator = Validator::make($request->all(), [
            'std_name'  => 'required|min:3',
            'std_phone' => 'required|min:10',
            'std_code'  => 'required|min:1|unique:member,std_code',
            'std_img'   => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        if ($validator->fails()) {
            return redirect('student/adding')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $imagePath = null;
            if ($request->hasFile('std_img')) {
                $imagePath = $request->file('std_img')
                    ->store('uploads/student', 'public');
            }

            StudentModel::create([
                'std_name'  => strip_tags($request->std_name),
                'std_phone' => strip_tags($request->std_phone),
                'std_code'  => $request->std_code,
                'std_img'   => $imagePath,
            ]);

            Alert::success('Insert Successfully');
            return redirect('/student');

        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    /* =======================
     *  EDIT FORM
     * ======================= */
    public function edit($id)
    {
        try {
            $student = StudentModel::findOrFail($id);
            return view('student.edit', compact('student'));
        } catch (\Exception $e) {
            return view('errors.404');
        }
    }

    /* =======================
     *  UPDATE
     * ======================= */
    public function update(Request $request, $id)
    {
        $messages = [
            'std_name.required'  => 'กรุณากรอกชื่อ',
            'std_name.min'       => 'ต้องมีอย่างน้อย :min ตัวอักษร',

            'std_phone.required' => 'กรุณากรอกเบอร์โทร',
            'std_phone.min'      => 'ต้องมีอย่างน้อย :min ตัวอักษร',
            'std_phone.max'      => 'ต้องมีอย่างน้อย :max ตัวอักษร',

            'std_code.required'  => 'ห้ามว่าง',
            'std_code.unique'    => 'รหัสนักศึกษานี้ถูกใช้แล้ว',

            'std_img.mimes'      => 'รองรับ jpeg, png, jpg เท่านั้น',
            'std_img.max'        => 'ขนาดไฟล์ไม่เกิน 5MB',
        ];

        $validator = Validator::make($request->all(), [
            'std_name'  => 'required|min:3',
            'std_phone' => 'required|min:1|max:10',
            'std_code'  => 'required|min:1|unique:member,std_code,' . $id,
            'std_img'   => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ], $messages);

        if ($validator->fails()) {
            return redirect('student/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $student = StudentModel::findOrFail($id);

            if ($request->hasFile('std_img')) {
                if ($student->std_img && Storage::disk('public')->exists($student->std_img)) {
                    Storage::disk('public')->delete($student->std_img);
                }

                $student->std_img = $request->file('std_img')
                    ->store('uploads/student', 'public');
            }

            $student->std_name  = strip_tags($request->std_name);
            $student->std_phone = strip_tags($request->std_phone);
            $student->std_code  = $request->std_code;
            $student->save();

            Alert::success('Update Successfully');
            return redirect('/student');

        } catch (\Exception $e) {
            //return view('errors.404');
            return "Error: " . $e->getMessage();
        }
    }

    /* =======================
     *  DELETE
     * ======================= */
    public function remove($id)
    {
        try {
            $student = StudentModel::find($id);

            if (!$student) {
                Alert::error('Student not found');
                return redirect('/student');
            }

            if ($student->std_img && Storage::disk('public')->exists($student->std_img)) {
                Storage::disk('public')->delete($student->std_img);
            }

            $student->delete();
            Alert::success('Delete Successfully');
            return redirect('/student');

        } catch (\Exception $e) {
            Alert::error('เกิดข้อผิดพลาด');
            return redirect('/student');
        }
    }
}
