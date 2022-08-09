<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function add()
    {
        return view('admin.payment_gateway.add');
    }
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'image_id' => 'required',
        ];

        $request->validate($rules);
        $data = $request->all();
        if ($request->hasFile('image_id')) {

            $image = $request->file('image_id');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $path = public_path('assets/admin/payment/');
            $image->move($path, $image_name);

            $data['image_id'] = 'assets/admin/payment/' . $image_name;
        }
        if ($created = PaymentMethod::create($data)) {
            // $mentee = [
            //     'user_id' => $created->id,
            //     'is_active' => 1
            // ];
            // Mentee::create($mentee);
            $notify[] = ['success', 'Payment Method has been added'];
            return redirect()->route('admin.payment_gateway.list')->withNotify($notify);
        } else {
            $notify[] = ['error', 'Something problem in internal system'];
            return back()->withNotify($notify);
        }
    }
    public function list(){
        $paymentMethods=PaymentMethod::all();
        return view('admin.payment_gateway.list',compact('paymentMethods'));
    }
    public function edit($id){
        $paymentMethod=PaymentMethod::find($id);
        return view('admin.payment_gateway.edit',compact('paymentMethod'));
    }

    public function update(Request $request){

        $data = $request->all();
        if ($request->hasFile('image_id')) {

            $image = $request->file('image_id');
            $image_name = time() . '_' . $image->getClientOriginalName();
            $path = public_path('assets/admin/payment/');
            $image->move($path, $image_name);

            $data['image_id'] = 'assets/admin/payment/' . $image_name;
        }
        $payment_method=PaymentMethod::find($request->id);
        if ($payment_method->update($data)) {

            $notify[] = ['success', 'Payment Method has been Updated'];
            return redirect()->route('admin.payment_gateway.list')->withNotify($notify);
        } else {
            $notify[] = ['error', 'Something problem in internal system'];
            return back()->withNotify($notify);
        }

    }
    public function destroy($id){

        $payment_method=PaymentMethod::destroy($id);
        $notify[] = ['success', 'Payment Method has been Deleted'];
        return redirect()->route('admin.payment_gateway.list')->withNotify($notify);
    }
}
