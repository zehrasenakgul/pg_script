<?php

namespace App\Http\Controllers\PaymentGateway;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use KingFlamez\Rave\Facades\Rave;
use App\Http\Controllers\Front\AppointmentBookingController;
use App\Models\User;
class FlutterWave extends Controller
{
     /**
     * Initialize Rave payment process
     * @return void
     */
    public function initialize(Request $request)
    {
        $request->session()->put('bookAppointmentId', $request->bookAppointmentId);

        $request->session()->save();
        $user=User::find($request->mentee_id);
        //This generates a payment reference
        $reference = Rave::generateReference();

        // Enter the details of the payment
        $data = [
            'payment_options' => 'card,banktransfer',
            'amount' => $request->total,
            'email' => isset($user)?$user->email:'hassan@gmail.com',
            'tx_ref' => $reference,
            'currency' => "USD",
            'redirect_url' => route('callback'),
            'customer' => [
                'email' =>isset($user->email)?$user->email:'hassan@gmail.com',
                "phone_number" => isset($user->phone)?$user->phone:'00923446925147',
                "name" => isset($user->first_name)?$user->first_name:'00923446925147'
            ],

            // "customizations" => [
            //     "title" => 'Movie Ticket',
            //     "description" => "20th October"
            // ]
        ];

        $payment = Rave::initializePayment($data);


        if ($payment['status'] !== 'success') {
            // notify something went wrong

            return $payment;
        }


        return redirect($payment['data']['link']);
    }

    /**
     * Obtain Rave callback information
     * @return void
     */
    public function callback()
    {

        $status = request()->status;

        //if payment is successful
        if ($status ==  'successful') {

        $transactionID = Rave::getTransactionIDFromCallback();
        $data = Rave::verifyTransaction($transactionID);

        $bookAppointmentId=session('bookAppointmentId');
                $appointment=new AppointmentBookingController();
                $appointment_res=$appointment->updateAppointmentAfterPayment($bookAppointmentId,4);
                session()->forget('bookAppointmentId');
                session()->flush();
                $result="Successfully Done Payment !";
                return view('thank-you',compact('result'));
        }
        elseif ($status ==  'cancelled'){
            //Put desired action/code after transaction has been cancelled here

            session()->forget('bookAppointmentId');
            session()->flush();
            $result="Transaction Failed";
            return view('thank-you',compact('result'));
        }
        else{
            session()->forget('bookAppointmentId');
            session()->flush();
            $result="Transaction Failed";
            return view('thank-you',compact('result'));
        }
        // Get the transaction from your DB using the transaction reference (txref)
        // Check if you have previously given value for the transaction. If you have, redirect to your successpage else, continue
        // Confirm that the currency on your db transaction is equal to the returned currency
        // Confirm that the db transaction amount is equal to the returned amount
        // Update the db transaction record (including parameters that didn't exist before the transaction is completed. for audit purpose)
        // Give value for the transaction
        // Update the transaction to note that you have given value for the transaction
        // You can also redirect to your success page from here

    }
    public function updateAppointment(Request $request){
        $validator = Validator::make($request->all(), [
            'appointment_id' => 'required',
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $appointment=new AppointmentBookingController();
        $appointment_res=$appointment->updateAppointmentAfterPayment($request->appointment_id,4);
        $obj=["Status"=>true,"success"=>1,"msg"=>"Successfully Updated Appointment Status"];
        return response()->json($obj);

    }
}
