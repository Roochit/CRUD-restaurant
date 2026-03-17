<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request; //รับค่าจากฟอร์ม
use Illuminate\Support\Facades\Validator; //form validation
use RealRashid\SweetAlert\Facades\Alert; //sweet alert
use Illuminate\Support\Facades\Storage; //สำหรับเก็บไฟล์ภาพ
use Illuminate\Pagination\Paginator; //แบ่งหน้า
use App\Models\ProductModel; //model
use Illuminate\Support\Facades\DB; //query builder



class HomeController extends Controller
{

    public function index(){
 
    try {
        //insert counter
          DB::table('counter_viwer')->insert([
            'c_date' => now()
         ]);
         
         Paginator::useBootstrap(); // ใช้ Bootstrap pagination
         $allProduct = ProductModel::orderBy('id', 'desc')->paginate(8); //order by & pagination
       
        return view('home.product_index', compact('allProduct'));
 
        
    
 
        // return response()->json([
        //     'status' => 'success'
        // ]);
       
 
    } catch (\Exception $e) {
         return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
         return view('/');
    }
}

   




public function detail ($id)
{
        try {
            $product = ProductModel::findOrFail($id); // ใช้ findOrFail เพื่อให้เจอหรือ 404

            //ประกาศตัวแปรเพื่อส่งไปที่ view
            if (isset($product)) {
                $id = $product->id;
                $product_name = $product->product_name;
                $product_detail = $product->product_detail;
                $product_reviwe = $product->product_reviwe;
                $product_img = $product->product_img;
                return view('home.product_detail', compact('id', 'product_name', 'product_detail', 'product_reviwe', 'product_img'));
            }
        } catch (\Exception $e) {
            //return response()->json(['error' => $e->getMessage()], 500); //สำหรับ debug
            return view('/');
        }
} 

    // show product with search
public function searchProduct(Request $request) {
    // print_r($_GET);
    // exit;

    Paginator::useBootstrap(); // ใช้ Bootstrap pagination

    $keyword = $request->keyword;

    if (strlen($keyword) > 0) {
        // query data by searching
        $allProduct = ProductModel::where('product_name', 'like', "%{$keyword}%")->paginate(8);
    } else {
        $allProduct = ProductModel::orderBy('id', 'desc')->paginate(8); // 8 products/page
    }

    return view('home.product_index', compact('allProduct', 'keyword'));
} // searchProduct

   

} //class
