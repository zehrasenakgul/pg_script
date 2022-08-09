<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithDrawRequest;
use App\Models\NewsLetter;
use App\Models\User;

class WithDrawController extends Controller
{
    //withdraw request list
    public function withdraw_list(){
        $withRrawRequests=WithDrawRequest::all();
        return view('admin.withdraw_request.list',compact('withRrawRequests'));
    }
    //make it paid
    public function paid_withdraw($id){
        $withRrawRequest=WithDrawRequest::find($id);
        $user=User::find($withRrawRequest->user_id );
        $transaction= $user->withdraw($withRrawRequest->amount);


        $withRrawRequest->update(['status'=>1]);
        return redirect('admin/withdraw-list');

    }
    //newsletters list
    public function newsletter_list(){
        $newsletters=NewsLetter::all();
        return view('admin.newsletter.index',compact('newsletters'));
    }
}
