<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


use App\Models\PaymentMethodSetting;




class PaymentMethod extends Model
{

    use HasFactory;
    public $translatable = ['name','description'];
    protected $fillable = ['name','description','code','image_id','is_active','is_default'];

    public function settings(){
      return $this->hasMany(PaymentMethodSetting::class,'payment_method_id');
    }

}
