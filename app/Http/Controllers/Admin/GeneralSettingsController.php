<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
class GeneralSettingsController extends Controller
{
    public function index(){
        $general=GeneralSetting::first();
        return view('admin.general_setting.add',compact('general'));
    }
    public function store(Request $request){

        $rules = [
    		'title' => 'required',
            'tagline'=>'required',
            'seo_Des'=>'required',

            'seo_keywords'=>'required',
            'facebook_link'=>'required',
            'twitter_link'=>'required',
            'linkden_link'=>'required',
            // 'logo'=>'required',
            "address"=>'required',
            "phone"=>'required',

            "company_email"=>'required',
            "about_company"=>'required',




    	];

        $created=null;
    	$request->validate($rules);
        $data=$request->all();
        // dd($data);

        if($request->hasFile('logo')){

			$image = $request->file('logo');
			$image_name = time().'_'.$image->getClientOriginalName();
			$path = public_path('assets/admin/general_settings/');
			$image->move($path,$image_name);

			$data['logo'] = '/assets/admin/general_settings/'.$image_name;

		}

        if($request->has('id')){
            $general=GeneralSetting::find($request->id);
            $created=$general->update($data);
        }else{
            $created=GeneralSetting::create($data);
        }
        if($created ){

			$notify[] = ['success', 'General Settings has been added'];
        	return redirect()->route('admin.general.add')->withNotify($notify);
		}else{
			$notify[] = ['error', 'Something problem in internal system'];
        	return back()->withNotify($notify);
		}
    }
}
