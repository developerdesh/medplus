<?php
namespace App\Http\Controllers;
use App\Models\myorders;
use App\Models\Allproducts;
use App\Models\orderplaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MyordersController extends Controller
{
    public function index(Request $request){
       
        // Printing the value of myorderid // Or use dd($myorderid) for debugging
         $myorders_result=orderplaced::select('*')
        ->where('userID',Auth::id())
        ->orderBy('created_at', 'desc')
        ->get()
        ->toArray();

        return view('Myorders',['myorders_result'=>$myorders_result]);
    }
    public function returnproduct($productID){
       
        orderplaced::where('id',$productID)->where('userID',Auth::id())->update([
            'status'=>'Returned',
         ]);

         return back();
       

        // $myorder_returned=myorders::select('delivery_status')->where('id',$productID)->where('userID',Auth::id())->get()->toArray();
        // if($myorder_returned['0']['delivery_status']=='Returned'){
        //     return redirect()->back()->with('statusUpdate',true);
        // }

    }
   
}
