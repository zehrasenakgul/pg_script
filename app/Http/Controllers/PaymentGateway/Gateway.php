<?php

namespace App\Http\Controllers\PaymentGateway;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Http\Requests\PaymentGatewayRequest;
use App\Http\Controllers\PaymentGateway\Stripe;
use App\Http\Controllers\PaymentGateway\Braintree;
use App\Http\Controllers\PaymentGateway\Paypal;
use App\Http\Controllers\PaymentGateway\Razorpay;
use App\Http\Controllers\Front\AppointmentBookingController;
use App\Http\Controllers\Front\WalletController;
use App\Models\User;

class Gateway extends Controller
{
    /********* Initialize Permission based Middlewares  ***********/
    public function __construct()
    {
    }
    // Posts
    public function index(PaymentGatewayRequest $request)
    {


        $payment_method_settings = PaymentMethod::with('settings')->where('code', $request->payment_method_code)->first();
        $customer = User::find($request->mentee_id);

        if ($payment_method_settings) {




            if ($payment_method_settings->code == 'stripe') {
                //stripe
                $gateway = new Stripe();
                $gateway->setAuthorizationKeys($payment_method_settings->settings);
                // return response()->json($gateway);
                $res = $gateway->executePayment($request->all(), $customer);
                // return response()->json($res);
                if ($res['captured'] == true && $res['success'] == true) {
                    //creating Book
                    //Successfully Payment Captured
                    //update book Appointment
                    if($request->has('bookAppointmentId')){
                        $appointment=new AppointmentBookingController();
                        $appointment_res=$appointment->updateAppointmentAfterPayment($request->bookAppointmentId,$payment_method_settings->id);

                        return response()->json($appointment_res);
                    }
                    else if($request->has('wallat_desposit')){
                        $wallet=new WalletController();
                        $wallet_response=$wallet->depositFromGateway($request->mentee_id,$request->total);
                        return response()->json($wallet_response);

                    }


                } else if ($res['success'] == true && $res['captured'] == false) {
                    //Success But Needs 2-Fatctor Auth by Uders Usign authorization_url Generated in res


                    session(['bookAppointmentId' => $request->bookAppointmentId]);
                    $obj=['Status'=>false,'success'=>0,'authorization_url'=>$res['authorization_url']];
                    return response()->json($obj);

                } else {


                    
                    return response()->json($res);
                }
            }
            else if ($payment_method_settings->code == 'razorpay') {
                //stripe
                $gateway = new Razorpay();
                $gateway->setAuthorizationKeys($payment_method_settings->settings);
                // return response()->json($gateway);
                $res = $gateway->execute_payment($request->all(), $customer);
                return response()->json($res);
                if ($res['captured'] == true && $res['success'] == true) {
                    //creating Book
                    //Successfully Payment Captured


                } else if ($res['success'] == true && $res['captured'] == false) {
                    //Success But Needs 2-Fatctor Auth by Uders Usign authorization_url Generated in res

                    if ($order_res['success'] == true) {
                        //Successfully Order Generated , Redirect Url (take user on url for opt)

                        return response()->json($res);
                    } else {
                        return response()->json(["message" => "Contact Support Please, Sorry for in Convi.."]);
                    }
                } else {


                    //Error Occurs Duting Payment Api Call E.g Card Invalid..
                    return response()->json($res);
                }
            } else if ($payment_method_settings->code == 'braintree') {
                //BrainTree
                $gateway = new Braintree();
                $gateway->setAuthorizationKeys($payment_method_settings->settings);

                $res = $gateway->executePayment($request->all(), $customer);
                // return response()->json($res);
                if ($res['captured'] == true && $res['success']==true) {
                    // payment Done
                    //book appointment
                    $appointment=new AppointmentBookingController();
                    $appointment_res=$appointment->updateAppointmentAfterPayment($request->bookAppointmentId,$payment_method_settings->id);

                    return response()->json($appointment_res);
                    // return response()->json($res);
                } else {
                    //error payment not successfull
                    return response()->json($res);
                }
            } else if ($payment_method_settings->code == 'instamojo') {
                //Instamojo
                //    $gateway = new Instamojo();
                //  $gateway->setAuthorizationKeys($payment_method_settings->settings);
                //  $res = $gateway->executePayment($request->all(),$customer);
                return response()->json(["message" => "Underconstruction"]);
            } else if ($payment_method_settings->code == 'paypal') {
                //Paypal
                $gateway = new Paypal();
                $gateway->setAuthorizationKeys($payment_method_settings->settings);
                $res = $gateway->executePayment($request->all(), $customer);

                if ($res['success']==true && $res['captured'] == true) {
                    // payment Done
                    //book appointment
                    $appointment=new AppointmentBookingController();
                    $appointment_res=$appointment->updateAppointmentAfterPayment($request->bookAppointmentId,$payment_method_settings->id);

                    return response()->json($appointment_res);

                }

                //payment not done
                else if ($res['authorization_required']==true && $res['captured'] == false) {
                    session(['bookAppointmentId' => $request->bookAppointmentId]);
                    $obj=['Status'=>false,'success'=>0,'authorization_url'=>$res['authorization_url']];
                    return response()->json($obj);
                }
                // return response()->json($res);
            } else if ($payment_method_settings->code == 'paytm') {
                //Paypal
                //    $gateway = new Paytm();
                //  $gateway->setAuthorizationKeys($payment_method_settings->settings);
                //  $res = $gateway->executePayment($request->all(),$customer);
                //  return response()->json($res);
                return response()->json(["message" => "Underconstruction"]);
            } else {
                $res = [
                    'message' => 'Method Not Implemented'
                ];
                return response()->json($res);
            }
        } else {
            return response("No Such Payment Method Exists", 404);
        }
    }
    // public function verifyPayment(Request $request){
    //   $data = $request->all();
    //   foreach($data as $data)
    //     {
    //       $data = $data;
    //     }
    // $payment_method_settings = new PaymentMethodsResource(PaymentMethod::withAll()->where('code', $data[0]['payment_method_code'])->first());
    //   if($payment_method_settings->code == 'stripe')
    //   {
    //     $strpie = new Stripe();
    //     $strpie->setAuthorizationKeys($payment_method_settings->settings);
    //     $response = $strpie->verifyPayment($data[0]['params']);
    //     if($response['captured'] == true){
    //       $order_id = Order::find($data[0]['order_id']);
    //       $order_id->update([
    //         'transaction_status' => 'captured',
    //         'is_paid' => 1
    //       ]);
    //     }
    //     return response()->json($response);
    //   }else if($payment_method_settings->code == 'paypal')
    //   {
    //     $gateway = new Paypal();
    //     $gateway->setAuthorizationKeys($payment_method_settings->settings);
    //     $response = $gateway->verifyPayment($data[0]['params']);
    //     if($response['captured'] == true){
    //       $order_id = Order::find($data[0]['order_id']);
    //       $order_id->update([
    //         'transaction_status' => 'captured',
    //         'is_paid' => 1
    //       ]);
    //     }
    //     return response()->json($response);
    //   }else if($payment_method_settings->code == 'instamojo')
    //   {
    //     //  $gateway = new Instamojo();
    //     //  $gateway->setAuthorizationKeys($payment_method_settings->settings);
    //     //  $response = $gateway->verifyPayment($data[0]['params']);
    //     //  return response()->json($response);
    //     $res = [
    //       'message' => 'Method Not Implemented'
    //     ];
    //       return response()->json($res);

    //   }else
    //   {
    //     $res = [
    //       'message' => 'Method Not Implemented'
    //     ];
    //       return response()->json($res);
    //   }
    // }
}
