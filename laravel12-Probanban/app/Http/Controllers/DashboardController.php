<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\ProductModel;
use App\Models\CounterModel;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        try {
            // 1. แก้เป็นคอลัมน์ที่คุณมี (ในรูปไม่มี product_price ถ้าจะนับค่า review แทนให้ใช้ชื่อนี้ครับ)
            // หรือถ้ายังไม่มีคอลัมน์ราคาจริงๆ ให้ใส่ 0 ไว้ก่อนกัน Error ครับ
            $Sumprice = ProductModel::sum('product_reviwe'); // ในรูปสะกด product_reviwe (มี e หลัง w)
        
            $CountAdmin = AdminModel::count();  

            // 2. ตรวจสอบใน ProductModel ว่าตั้งชื่อ $table = 'restaurants' ไว้แล้วใช่ไหม
            $CountPrd = ProductModel::count();  

            $CountView = DB::table('counter_viwer')->count();

// ดึงข้อมูลยอดวิวรายเดือน
            $monthlyVisits = DB::table('counter_viwer')
                ->selectRaw('DATE_FORMAT(c_date, "%M-%Y") as ym, COUNT(*) as total')
                // ลบบรรทัด selectRaw อันที่สองที่ซ้ำออกไป
                ->groupBy('ym') 
                // ใช้รหัสปี-เดือน (YYYY-MM) ในการเรียงเพื่อให้กราฟเรียงจากเดือนล่าสุดไปย้อนหลัง
                ->orderByRaw('MIN(c_date) DESC') 
                ->limit(12)
                ->get();
                        
            $labels = $monthlyVisits->pluck('ym')->toArray();
            $data   = $monthlyVisits->pluck('total')->toArray();
            
            return view('dashboard.index', compact('labels','data','CountAdmin','CountPrd','CountView','Sumprice'));

        } 
        catch (\Exception $e) {
            // แนะนำให้ return error ออกมาดูจนกว่าจะแก้เสร็จครับ จะได้ไม่หลงทางกับหน้า 404
            return "พังเพราะสาเหตุนี้ครับ: " . $e->getMessage();
        }
    }

    

} //class
