<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BookAppointment;
use Illuminate\Support\Facades\Validator;
use App\Models\Mentor;
use App\Models\Mentee;
use App\Models\MentorSchedule;
use App\Models\MentorScheduleSlot;
use App\Models\Rating;
use Carbon\Carbon;
use App\Models\MentorAssignCategory;
use App\Models\MentorCategory;
use PDF;
use App\Models\Commission;
use App\Models\User;
class AppointmentBookingController extends Controller
{

    //Appointment Booking Function
    public function bookAppointment(Request $request){
        //return response()->json($_FILES['book_file']['error']);
        $validator = Validator::make($request->all(), [
            'mentee_id' => 'required',
            'mentor_id' => 'required',
            'payment' => 'required',
            'questions'=>'required|string',
            'appointment_type_string'=>'required|string',
            'appointment_type_id'=>'required',
            'payment_id'=>'required',
            //'book_file'=>'required|max:20048'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        $mentee_id=$request->mentee_id;
        $mentor_id=$request->mentor_id;
        $payment=$request->payment;
        $questions=$request->questions;
        $payment_id=$request->payment_id;
        $appointment_type_string=$request->appointment_type_string;
        $appointment_type_id=$request->appointment_type_id;
        $date=date_format(date_create($request->date),"Y-m-d");
        $time=$request->time;
        $file_name='';
        if ($request->token==$token){
            if ($request->has('bookAppointmentId')) {
                if($request->hasFile('book_file')){




                    $image = $request->file('book_file');
                    $file_type =$image->getClientOriginalExtension();
                    $image_name = time().'_'.$image->getClientOriginalName();
                    $path = public_path('assets/bookappointment/');
                    $image->move($path,$image_name);

                    $file_name = 'assets/bookappointment/'.$image_name;
                    $updated=BookAppointment::find($request->bookAppointmentId)->update([
                        'mentee_id'=>$mentee_id,
                        'mentor_id'=>$mentor_id,
                        'date'=>$date,
                        'time'=>$time,
                        'payment'=>$payment,
                        'payment_id'=>$payment_id,
                        'appointment_type_string'=>$appointment_type_string,
                        'appointment_type_id'=>$appointment_type_id,

                        'questions'=>$questions,
                        'file'=>!empty($file_name)? $file_name:'',
                        'file_type'=>!empty($file_name)? $file_type:'',

                    ]);


                }else {
                    $updated=BookAppointment::find($request->bookAppointmentId)->update([
                        'mentee_id'=>$mentee_id,
                        'mentor_id'=>$mentor_id,
                        'date'=>$date,
                        'time'=>$time,
                        'payment'=>$payment,
                        'payment_id'=>$payment_id,
                        'appointment_type_string'=>$appointment_type_string,
                        'appointment_type_id'=>$appointment_type_id,

                        'questions'=>$questions

                    ]);
                }
                $updatedRecord=BookAppointment::find($request->bookAppointmentId);

                $obj=["Status"=>true,"success"=>1,"data"=>["appointmentNo"=>$updatedRecord->id],"msg"=>"Booked Appointment Updated Successfully"];

                return response()->json($obj);
            } else {

                if($request->hasFile('book_file')){




                    $image = $request->file('book_file');
                    $file_type =$image->getClientOriginalExtension();
                    $image_name = time().'_'.$image->getClientOriginalName();
                    $path = public_path('assets/bookappointment/');
                    $image->move($path,$image_name);

                    $file_name = 'assets/bookappointment/'.$image_name;



                }
                $created=BookAppointment::create([
                    'mentee_id'=>$mentee_id,
                    'mentor_id'=>$mentor_id,
                    'date'=>$date,
                    'time'=>$time,
                    'payment'=>$payment,
                    'payment_id'=>$payment_id,
                    'appointment_type_string'=>$appointment_type_string,
                    'appointment_type_id'=>$appointment_type_id,

                    'questions'=>$questions,
                    'file'=>!empty($file_name)? $file_name:'',
                    'file_type'=>!empty($file_name)? $file_type:'',

                ]);
                $obj=["Status"=>true,"success"=>1,"data"=>["appointmentNo"=>$created->id],"msg"=>"Booked Appointment Successfully"];

                return response()->json($obj);

            }


        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //Mentee Appointments
    public function pendingAppointments(Request $request){
        $validator = Validator::make($request->all(), [
            'mentee_id' => 'required'
            //'book_file'=>'required|max:20048'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $pendingAppointments='';
            if($request->has('status')){
                $pendingAppointments=BookAppointment::with('mentor')->where([['mentee_id',$request->mentee_id]
                ,['appointment_status',$request->status]
                ])->orderBy('id','DESC')->paginate(20);
            // $pendingAppointments=BookAppointment::with('mentor')->where('mentee_id',$request->mentee_id)->orderBy('id','DESC')->paginate(20);

            $appointments=$pendingAppointments->items();
            }else {
                $pendingAppointments=BookAppointment::with('mentor')->where([['mentee_id',$request->mentee_id]])->orderBy('id','DESC')->paginate(20);
            // $pendingAppointments=BookAppointment::with('mentor')->where('mentee_id',$request->mentee_id)->orderBy('id','DESC')->paginate(20);

            $appointments=$pendingAppointments->items();
            }

            $cat=[];
            foreach($appointments as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);

                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();
                //array_push($cat,$mentor_detail);
                $appointment['category']=isset($mentorCategory)?$mentorCategory->name:'';
            }
            $obj=["Status"=>true,"success"=>1,"data"=>["appointments"=>$pendingAppointments],"msg"=>"Got  Appointments Successfully"];

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //Mentee New Appointments
    public function completedAppointments(Request $request){
        $validator = Validator::make($request->all(), [
            'mentee_id' => 'required'
            //'book_file'=>'required|max:20048'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $completedAppointments=BookAppointment::with('mentor')->where([['mentee_id',$request->mentee_id],['appointment_status',0]])->orderBy('id', 'desc')->paginate(20);
            $appointments=$completedAppointments->items();
            $cat=[];
            foreach($appointments as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();
                //array_push($cat,$mentor_detail);
                $appointment['category']=$mentorCategory->name;
            }
            //return $cat;
            $obj=["Status"=>true,"success"=>1,"data"=>["newAppointments"=>$completedAppointments],"msg"=>"Got New Appointments Successfully"];

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //Mentor  Appointments
    public function completedMentorAppointments(Request $request){
        $validator = Validator::make($request->all(), [
            'mentor_id' => 'required'
            //'book_file'=>'required|max:20048'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            //['is_paid',1],['appointment_status','!=',0]
            $completedAppointments=BookAppointment::with(['mentee'=>function($q){
                $q->with(['mentee'=>function($q){
                    $q->select('identity_hidden','user_id');
                }]);
            }])->where([['mentor_id',$request->mentor_id],['appointment_status',2]])->orderBy('id','DESC')->paginate(20);
            foreach($completedAppointments->items() as $completedAppointment){
                if(!is_null($completedAppointment->date)){
                    $timestamp = strtotime($completedAppointment->date);
                    $day = date('l', $timestamp);
                    $day = strtolower($day);
                    $schedule_id = MentorSchedule::select('id')->where([['mentor_id',$completedAppointment->mentor_id]
                    ,['day',$day],['appointment_type_id',$completedAppointment->appointment_type_id]])->first();

                    if(isset($schedule_id)){
                        $end_time = MentorScheduleSlot::select('end_time')->where('schedule_id',$schedule_id->id)->where('start_time',$completedAppointment->time)->first();
                        $completedAppointment['end_time']=isset($end_time)?$end_time->end_time:'';
                    }else {
                        $completedAppointment['end_time']='';
                    }

                    if(is_null($completedAppointment->mentee->mentee)){
                        // dd($completedAppointment->mentee->mentee);
                        // $completedAppointment->mentee['mentee']['identity_hidden']=0;
                        // $completedAppointment->mentee['mentee']['user_id']=$completedAppointment->mentee_id;

                    }
                }

                // $completedAppointment['schedule_id']=$completedAppointment->mentor_id .'--'.$day;

            }
            $obj=["Status"=>true,"success"=>1,"data"=>["Appointments"=>$completedAppointments],"msg"=>"Got  Appointments Successfully"];

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //Mentor New Appointments
    public function pendingMentorAppointments(Request $request){
        $validator = Validator::make($request->all(), [
            'mentor_id' => 'required'
            //'book_file'=>'required|max:20048'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            //,['is_paid',1]
            $completedAppointments=BookAppointment::with(['mentee'=>function($q)
            {
                $q->with(['mentee'=>function($q){
                    $q->select('identity_hidden','user_id');
                }]);
            }])->where([['mentor_id',$request->mentor_id],['appointment_status',0]])->orderBy('id', 'desc')->paginate(20);

            foreach($completedAppointments->items() as $completedAppointment){
                if(!is_null($completedAppointment->date)){
                    $timestamp = strtotime($completedAppointment->date);
                    $day = date('l', $timestamp);
                    $day = strtolower($day);
                    $schedule_id = MentorSchedule::select('id')->where([['mentor_id',$completedAppointment->mentor_id]
                    ,['day',$day],['appointment_type_id',$completedAppointment->appointment_type_id]])->first();
                    if(isset($schedule_id)){
                        $end_time = MentorScheduleSlot::select('end_time')->where('schedule_id',$schedule_id->id)->where('start_time',$completedAppointment->time)->first();
                        $completedAppointment['end_time']=isset($end_time)?$end_time->end_time:'';
                    }

                    $completedAppointment['schedule_id']=$schedule_id;

                }

            }
            $obj=["Status"=>true,"success"=>1,"data"=>["newAppointments"=>$completedAppointments],"msg"=>"Got Newest Appointments Successfully"];

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //get status wise appointments
    public function MentorAppointmentsStatusWise(Request $request){
        $validator = Validator::make($request->all(), [
            'mentor_id' => 'required'
            //'book_file'=>'required|max:20048'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            //,['is_paid',1]
            $completedAppointments=BookAppointment::with(['mentee'=>function($q)
            {
                $q->with(['mentee'=>function($q){
                    $q->select('identity_hidden','user_id');
                }]);
            }])->where([['mentor_id',$request->mentor_id],['appointment_status',$request->status]])->orderBy('id', 'desc')->paginate(20);

            foreach($completedAppointments->items() as $completedAppointment){
                if(!is_null($completedAppointment->date)){
                    $timestamp = strtotime($completedAppointment->date);
                    $day = date('l', $timestamp);
                    $day = strtolower($day);
                    $schedule_id = MentorSchedule::select('id')->where([['mentor_id',$completedAppointment->mentor_id]
                    ,['day',$day],['appointment_type_id',$completedAppointment->appointment_type_id]])->first();
                    if(isset($schedule_id)){
                        $end_time = MentorScheduleSlot::select('end_time')->where('schedule_id',$schedule_id->id)->where('start_time',$completedAppointment->time)->first();
                        $completedAppointment['end_time']=isset($end_time)?$end_time->end_time:'';
                        $completedAppointment['schedule_id']=$schedule_id;
                    }else {
                        $completedAppointment['end_time']='';
                        $completedAppointment['schedule_id']='';
                    }


                }

            }
            $obj=["Status"=>true,"success"=>1,"data"=>["newAppointments"=>$completedAppointments],"msg"=>"Got Newest Appointments Successfully"];

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //Accept Reject Mentor Appointments
    public function acceptRejectAppointment(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status'=>'required'
            //'book_file'=>'required|max:20048'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $completedAppointments=BookAppointment::where('id',$request->id)->update(['appointment_status'=>$request->status]);
            $obj=["Status"=>true,"success"=>1,"data"=>["appointment"=>$completedAppointments],"msg"=>"Appointment Status Updated Successfully"];

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
//Get Appointment Details By ID
    public function appointment_detail(Request $request){
        $validator = Validator::make($request->all(), [
            'appointment_id' => 'required',
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $completedAppointments=BookAppointment::with('mentor','mentee')->where('id',$request->appointment_id)->first();
            if($completedAppointments->mentor_id == $request->user_id || $completedAppointments->mentee_id == $request->user_id )
            {
                if(!is_null($completedAppointments->date)){
                    $timestamp = strtotime($completedAppointments->date);
                    $day = date('l', $timestamp);

                    $day = strtolower($day);
                    $schedule_id = MentorSchedule::select('id')->where([
                        ['mentor_id',$completedAppointments->mentor_id],
                        ['day',$day],
                        ['appointment_type_id',$completedAppointments->appointment_type_id]
                    ])->first();
                    if(isset($schedule_id)){
                        $end_time = MentorScheduleSlot::select('end_time')->where('schedule_id',$schedule_id->id)->where('start_time',$completedAppointments->time)->first();

                    $completedAppointments['end_time']=$end_time->end_time;

                    }else {
                        $completedAppointments['end_time']='';
                    }


                    $assignedCategory=MentorAssignCategory::where('mentor_id',$completedAppointments->mentor_id)->orderBy('id','DESC')->first();
                    $category=MentorCategory::where('id',$assignedCategory->category_id)->first();
                    $completedAppointments->mentor['category']=$category;
                    // $completedAppointments['schedule_id']=$schedule_id;

                }
                $visibility=Mentee::select('identity_hidden')->where('user_id',$completedAppointments->mentee_id)->first();
                if($visibility){
                    $completedAppointments['mentee_visibility']=$visibility->identity_hidden;
                }


                $obj=["Status"=>true,"success"=>1,"data"=>["appointment"=>$completedAppointments],"msg"=>"Appointment detail got Successfully"];
            }
            else
            {
                $obj=["Status"=>false,"success"=>0,"msg"=>"Not Authenticated"];

            }

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //All Anc Cancel Appointment Count
    public function allCancelappointmentCount(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $allAppointments=BookAppointment::where('mentor_id',$request->user_id)->count();
            $cancelAppointments=BookAppointment::where('mentor_id',$request->user_id)->where('appointment_status',3)->count();
            $obj=["Status"=>true,"success"=>1,"data"=>["allAppointmentsCount"=>$allAppointments,'cancelAppointments'=>$cancelAppointments],"msg"=>"Appointment Count got Successfully"];

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //All And Pending Apppointment Count
    public function appointmentCount(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $allAppointments=BookAppointment::where(function($q) use($request){
                $q->orWhere('mentor_id',$request->user_id);
                $q->orWhere('mentee_id',$request->user_id);

            })->count();
            $pendingAppointments=BookAppointment::where(function($q) use($request){
                $q->orWhere('mentor_id',$request->user_id);
                $q->orWhere('mentee_id',$request->user_id);

            })->where('appointment_status',0)->count();
            $obj=["Status"=>true,"success"=>1,"data"=>["allAppointmentsCount"=>$allAppointments,'pendingAppointments'=>$pendingAppointments],"msg"=>"Appointment Count got Successfully"];

            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //mentee Appointment Search
    public function searchAppointmentMentee(Request $request){
        $validator = Validator::make($request->all(), [
            'mentee_id'=>'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $search=$request->search;
            $results=BookAppointment::where('mentee_id',$request->mentee_id)->where(function($q) use($search){
                $q->orWhere('questions','like',"%{$search}%");
                $q->orWhere('id','like',"%{$search}%");
                // $q->orWhere('type','like',"%{$search}%");


            })->with('mentor')->get();
            $obj=["Status"=>true,"success"=>1,"data"=>["results"=>$results],"msg"=>" Successfully got Appointments "];

            return response()->json($obj);

        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //Mentor Appointment Search
    public function searchAppointment(Request $request){
        $validator = Validator::make($request->all(), [
            'mentor_id'=>'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $search=$request->search;
            $results='';
            if($request->has('status')){
                $results=BookAppointment::where([['mentor_id',$request->mentor_id],['appointment_status',$request->status]])->where(function($q) use($search){
                    $q->orWhere('questions','like',"%{$search}%");
                    $q->orWhere('id','like',"%{$search}%");
                    // $q->orWhere('type','like',"%{$search}%");


                })->with(['mentee'=>function($q){
                    $q->with(['mentee'=>function ($q){
                        $q->select('identity_hidden','user_id');
                    }]);
                }])->get();
            }else {
                $results=BookAppointment::where('mentor_id',$request->mentor_id)->where(function($q) use($search){
                    $q->orWhere('questions','like',"%{$search}%");
                    $q->orWhere('id','like',"%{$search}%");
                    // $q->orWhere('type','like',"%{$search}%");


                })->with(['mentee'=>function($q){
                    $q->with(['mentee'=>function ($q){
                        $q->select('identity_hidden','user_id');
                    }]);
                }])->get();
            }

            $obj=["Status"=>true,"success"=>1,"data"=>["results"=>$results],"msg"=>" Successfully got Appointments "];

            return response()->json($obj);

        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //search Appointment for Mentee
    public function searchAppointmentMenteeWeb(Request $request){
        $validator = Validator::make($request->all(), [
            'mentee_id'=>'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $results=BookAppointment::where('mentee_id',$request->mentee_id);
            if($request->search_pending && $request->search_pending_coulmn)
            {
                $results = $results->where($request->search_pending_coulmn,'like','%' .$request->search_pending . '%');
            }
            if($request->search_complete && $request->search_complete_coulmn)
            {
                $results = $results->where($request->search_complete_coulmn,'like','%' .$request->search_complete . '%');
            }
            if($request->selectFilter && $request->filter_coulmn)
            {
                if($request->selectFilter == 4)
                {
                    $request->selectFilter = '';
                }
                $results = $results->where($request->filter_coulmn,$request->selectFilter);
            }
            $results = $results->paginate($request->items_per_page);
            $obj=["Status"=>true,"success"=>1,"data"=>["results"=>$results],"msg"=>" Successfully got Appointments "];

            return response()->json($obj);

        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //Appointments Filgter for Mentee
    public function filterAppointmentsMentee(Request $request){
        $validator = Validator::make($request->all(), [
            'appointment_status' => 'required',
            'mentee_id'=>'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $appointment_status=$request->appointment_status;
            if($appointment_status == 4)
            {
                $results=BookAppointment::where('mentee_id',$request->mentee_id)->with('mentor')->get();
            }
            else
            {
                $results=BookAppointment::where('mentee_id',$request->mentee_id)->where('appointment_status',$appointment_status)->with('mentor')->get();
            }
            $obj=["Status"=>true,"success"=>1,"data"=>["results"=>$results],"msg"=>"Successfully got Appointments"];

            return response()->json($obj);
        }

        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //Appointments Filter for mentor
    public function filterAppointments(Request $request){
        $validator = Validator::make($request->all(), [
            'appointment_status' => 'required',
            'mentor_id'=>'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $appointment_status=$request->appointment_status;
            if($appointment_status == 4)
            {
                $results=BookAppointment::where('mentor_id',$request->mentor_id)->with(['mentee'=>function($q)
                {

                    $q->with(['mentee'=>function ($q){
                        $q->select('identity_hidden','user_id');
                    }]);
                }])->get();
            }
            else{

                $results=BookAppointment::where('mentor_id',$request->mentor_id)->where('appointment_status',$appointment_status)->with(['mentee'=>function($q)
                {
                    $q->with(['mentee'=>function ($q){
                        $q->select('identity_hidden','user_id');
                    }]);
                }])->get();
            }
            $obj=["Status"=>true,"success"=>1,"data"=>["results"=>$results],"msg"=>"Successfully got Appointments"];

            return response()->json($obj);
        }

        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }

    //Mentor Today's Accepted Appointment
    public function getTodayAppointment(Request $request){

        $validator = Validator::make($request->all(), [
            'mentor_id'=>'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){

            $results=BookAppointment::where([['mentor_id',$request->mentor_id],['appointment_status',1]
            ,['date',Carbon::today()]
            ])->with(['mentee'=>function($q){
                $q->with('mentee');
            }])->get();

            foreach($results as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
            }
            $obj=["Status"=>true,"success"=>1,"data"=>["results"=>$results],"msg"=>"Successfully got Appointments"];

            return response()->json($obj);
        }

        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //Mark Appointment Complete
    public function markAppointmentAsComplete(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'appointment_id'=>'required',
            'token' => 'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){

            $appointment_exist = BookAppointment::where('id', $request->appointment_id)->first();
            // dd($appointment_exist);
            if($appointment_exist)
            {
                $commission=Commission::first();
                $customer_amount=0;
                $amount=$commission->amount;
                if($commission->fixed){
                    $customer_amount=$appointment_exist->payment-$commission->amount;
                }else {
                    $amount=$appointment_exist->payment*$commission->amount/100;
                    $customer_amount=$appointment_exist->payment-$amount;
                }
                $user=User::find($appointment_exist->mentor_id);
                $user->deposit($customer_amount);
                $admin_user=User::find(1);
                $admin_user->deposit($amount);
                $completedAppointments=BookAppointment::where('id',$request->appointment_id)->update(['appointment_status'=>2]);

                $obj=["Status"=>true,"success"=>1,"msg"=>"Successfully Mark as Completed Appointments"];
            }
            else
            {
                $obj=["Status"=>false,"success"=>0,"msg"=>"Appointment Not Found"];

            }

            return response()->json($obj);
        }

        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    //check if appointment exist for date and time
    public function appointmentExistForDateTime(Request $request){
        $validator = Validator::make($request->all(), [
            'appointment_id'=>'required',
            "appointment_type_id"=>"required",
            'date' => 'required',
            "time"=>"required"
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        $token="123";
        if ($request->token==$token){
            $exist=BookAppointment::where([['mentor_id',$request->mentor_id],
            ['date',$request->date],['time',$request->time],
            ["appointment_type_id",$request->appointment_type_id]])->count();
            if($exist>0){
                $obj=["Status"=>true,"success"=>1,"msg"=>"Slot is already Booked for date"];
                return response()->json($obj);
            }
            $obj=["Status"=>true,"success"=>1,"msg"=>"Slot is free for date"];
            return response()->json($obj);
        }
        $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        return response()->json($obj);
    }
    public function completedAppointmentInvoice(Request $request,$appointment_id){
        // return $appointment_id;
        // $validator = Validator::make($request->all(), [
        //     'appointment_id'=>'required',
        // ]);
        // if ($validator->fails()) {

        //     $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
        //     return response()->json($obj);
        // }
        // $token="123";
        // if ($request->token==$token){
            $appointment=BookAppointment::with('mentor')->where('id',$request->appointment_id)->first();
            if($appointment->payment_id==0){
                $appointment['payment_method']="Jazzcash Mobile Account";
            }
            else if($appointment->payment_id==1){
                $appointment['payment_method']="Jazzcash Credit/Debit Card";

            }
            else if($appointment->payment_id==2){
                $appointment['payment_method']="EasyPaisa";

            }
            else if($appointment->payment_id==3){
                $appointment['payment_method']="Mashvra Wallet";

            }
            $pdf = PDF::loadView('invoice', compact('appointment'));

            // download PDF file with download method
                return $pdf->download('pdf_file.pdf');
        // }
        // $obj=["Status"=>false,"success"=>0,"msg"=>"Token Incorrect"];
        // return response()->json($obj);
    }

    //All Appointments status wise for mentee
    public function statusWiseAllAppointments(Request $request){
        $validator = Validator::make($request->all(), [
            'mentee_id' => 'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        if($request->has('appointment_status')){
            $appointments=BookAppointment::with(['mentor'=>function($q){
                $q->with('user_country');
            }])->where([['mentee_id',$request->mentee_id],['appointment_status','=',$request->appointment_status]])->orderBy('id','DESC')->paginate(1);
            // $appointments=$appointments->items();

            foreach($appointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
            }

            $obj=["Status"=>true,"success"=>1,"data"=>["appointments"=>$appointments,
            ],"msg"=>"Status Wise Appointments  got Successfully"];

            return response()->json($obj);
        }else {
            $pendingAppointments=BookAppointment::with(['mentor'=>function($q){
                $q->with('user_country');
            }])->where([['mentee_id',$request->mentee_id],['appointment_status','=',0]])->orderBy('id','DESC')->paginate(10);
            $acceptedAppointments=BookAppointment::with(['mentor'=>function($q){
                $q->with('user_country');
            }])->where([['mentee_id',$request->mentee_id],['appointment_status','=',1]])->orderBy('id','DESC')->paginate(10);
            $completedAppointments=BookAppointment::with(['mentor'=>function($q){
                $q->with('user_country');
            }])->where([['mentee_id',$request->mentee_id],['appointment_status','=',2]])->orderBy('id','DESC')->paginate(10);
            $cancelledAppointments=BookAppointment::with(['mentor'=>function($q){
                $q->with('user_country');
            }])->where([['mentee_id',$request->mentee_id],['appointment_status','=',3]])->orderBy('id','DESC')->paginate(10);
            foreach($pendingAppointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
            }
            foreach($acceptedAppointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
            }
            foreach($completedAppointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
            }
            foreach($cancelledAppointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
            }
            $obj=["Status"=>true,"success"=>1,"data"=>["pendingAppointments"=>$pendingAppointments,
            'acceptedAppointments'=>$acceptedAppointments,'completedAppointments'=>$completedAppointments,
            'cancelledAppointments'=>$cancelledAppointments
            ],"msg"=>"Status Wise Appointments  got Successfully"];

            return response()->json($obj);
        }

    }
    public function statusWiseAllAppointmentsForMentor(Request $request){
        $validator = Validator::make($request->all(), [
            'mentor_id' => 'required'
        ]);
        if ($validator->fails()) {

            $obj=["Status"=>false,"success"=>0,"errors"=>$validator->errors()];
            return response()->json($obj);
        }
        if($request->has('appointment_status')){
            $appointments=BookAppointment::with(['mentee'=>function($q){
                $q->with('mentee');
                $q->with('user_country');
            }])->where([['mentor_id',$request->mentor_id],['appointment_status','=',$request->appointment_status]])->orderBy('id','DESC')->paginate(1);
            // $appointments=$appointments->items();

            foreach($appointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
                if(!is_null($appointment->date)){
                    $timestamp = strtotime($appointment->date);
                    $day = date('l', $timestamp);
                    $day = strtolower($day);
                    $schedule_id = MentorSchedule::select('id')->where([['mentor_id',$appointment->mentor_id]
                    ,['day',$day],['appointment_type_id',$appointment->appointment_type_id]])->first();
                    $end_time = MentorScheduleSlot::select('end_time')->where('schedule_id',$schedule_id->id)->where('start_time',$appointment->time)->first();
                    $appointment['end_time']=isset($end_time)?$end_time->end_time:'';
                }
                else {
                    $appointment['end_time']='';
                }
            }

            $obj=["Status"=>true,"success"=>1,"data"=>["appointments"=>$appointments,
            ],"msg"=>"Status Wise Appointments  got Successfully"];

            return response()->json($obj);
        }else {
            $pendingAppointments=BookAppointment::with(['mentee'=>function($q){
                $q->with('mentee');
                $q->with('user_country');
            }])->where([['mentor_id',$request->mentor_id],['appointment_status','=',0]])->orderBy('id','DESC')->paginate(10);
            $acceptedAppointments=BookAppointment::with(['mentee'=>function($q){
                $q->with('mentee');
                $q->with('user_country');
            }])->where([['mentor_id',$request->mentor_id],['appointment_status','=',1]])->orderBy('id','DESC')->paginate(10);
            $completedAppointments=BookAppointment::with(['mentee'=>function($q){
                $q->with('mentee');
                $q->with('user_country');
            }])->where([['mentor_id',$request->mentor_id],['appointment_status','=',2]])->orderBy('id','DESC')->paginate(10);
            $cancelledAppointments=BookAppointment::with(['mentee'=>function($q){
                $q->with('mentee');
                $q->with('user_country');
            }])->where([['mentor_id',$request->mentor_id],['appointment_status','=',3]])->orderBy('id','DESC')->paginate(10);
            foreach($pendingAppointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
                if(!is_null($appointment->date)){
                    $timestamp = strtotime($appointment->date);
                    $day = date('l', $timestamp);
                    $day = strtolower($day);
                    $schedule_id = MentorSchedule::select('id')->where([['mentor_id',$appointment->mentor_id]
                    ,['day',$day],['appointment_type_id',$appointment->appointment_type_id]])->first();

                    if(isset($schedule_id)){
                        $end_time = MentorScheduleSlot::select('end_time')->where('schedule_id',$schedule_id->id)->where('start_time',$appointment->time)->first();
                    $appointment['end_time']=isset($end_time)?$end_time->end_time:'';
                    }else {
                        $appointment['end_time']='';
                    }

                }
                else {
                    $appointment['end_time']='';
                }
            }
            foreach($acceptedAppointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
                if(!is_null($appointment->date)){
                    $timestamp = strtotime($appointment->date);
                    $day = date('l', $timestamp);
                    $day = strtolower($day);
                    $schedule_id = MentorSchedule::select('id')->where([['mentor_id',$appointment->mentor_id]
                    ,['day',$day],['appointment_type_id',$appointment->appointment_type_id]])->first();

                    if(isset($schedule_id)){
                        $end_time = MentorScheduleSlot::select('end_time')->where('schedule_id',$schedule_id->id)->where('start_time',$appointment->time)->first();
                        $appointment['end_time']=isset($end_time)?$end_time->end_time:'';
                    }else {
                        $appointment['end_time']='';
                    }

                }
                else {
                    $appointment['end_time']='';
                }
            }
            foreach($completedAppointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
                if(!is_null($appointment->date)){
                    $timestamp = strtotime($appointment->date);
                    $day = date('l', $timestamp);
                    $day = strtolower($day);
                    $schedule_id = MentorSchedule::select('id')->where([['mentor_id',$appointment->mentor_id]
                    ,['day',$day],['appointment_type_id',$appointment->appointment_type_id]])->first();

                    if(isset($schedule_id)){
                        $end_time = MentorScheduleSlot::select('end_time')->where('schedule_id',$schedule_id->id)->where('start_time',$appointment->time)->first();
                    $appointment['end_time']=isset($end_time)?$end_time->end_time:'';
                    }else{
                        $appointment['end_time']='';
                    }

                }
                else {
                    $appointment['end_time']='';
                }
            }
            foreach($cancelledAppointments->items() as $appointment){
                $rating=Rating::where('mentor_id',$appointment->mentor_id)->avg('rating');
                $appointment['rating']=round($rating);
                $category_id=MentorAssignCategory::select('category_id','id')->where('mentor_id',$appointment->mentor_id)->orderBy('id','desc')->first();
                $mentorCategory=MentorCategory::where('id',$category_id->category_id)->first();

                $appointment['category']=$mentorCategory->name;
                if(!is_null($appointment->date)){
                    $timestamp = strtotime($appointment->date);
                    $day = date('l', $timestamp);
                    $day = strtolower($day);
                    $schedule_id = MentorSchedule::select('id')->where([['mentor_id',$appointment->mentor_id]
                    ,['day',$day],['appointment_type_id',$appointment->appointment_type_id]])->first();
                    $end_time = MentorScheduleSlot::select('end_time')->where('schedule_id',$schedule_id->id)->where('start_time',$appointment->time)->first();
                    $appointment['end_time']=isset($end_time)?$end_time->end_time:'';
                }else {
                    $appointment['end_time']='';
                }
            }
            $obj=["Status"=>true,"success"=>1,"data"=>["pendingAppointments"=>$pendingAppointments,
            'acceptedAppointments'=>$acceptedAppointments,'completedAppointments'=>$completedAppointments,
            'cancelledAppointments'=>$cancelledAppointments
            ],"msg"=>"Status Wise Appointments  got Successfully"];

            return response()->json($obj);
        }

    }
    public function updateAppointmentAfterPayment($appointmentId,$payment_id){
        BookAppointment::where('id',$appointmentId)->update([
            'is_paid'=>1,
            'payment_id'=>$payment_id
        ]);
        $obj=["Status"=>true,"success"=>1,'msg'=>'Appointment Payment status updated'];
        return response()->json($obj);
    }
}
