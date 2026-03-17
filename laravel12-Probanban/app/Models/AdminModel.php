<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Authenticatable
{
   protected $table = 'staff_accounts';
   protected $primaryKey = 'id'; // ตั้งให้ตรงกับชื่อจริงใน DB
   protected $fillable = ['admin_name', 'admin_username', 'admin_password', 'dateCreate'];
   public $incrementing = true; // ถ้า primary key เป็นตัวเลข auto increment
   public $timestamps = false;

   // ระบุให้ Laravel รู้ว่าใช้ password column ไหน
   public function getAuthPassword()
   {
       return $this->admin_password;
   }

}

