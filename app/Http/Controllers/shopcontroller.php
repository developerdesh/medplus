<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ALLproducts;
use App\Models\categorymodel;

use Illuminate\Http\Request;

class shopcontroller extends Controller
{
    public function index(Request $request){
        if(isset($request->categories)){
        $categoryarray=explode(',',$request->get('categories'));
        $categories=categorymodel::select('*')->where(['status'=>1])->get()->toArray();
        $products=ALLproducts::whereIn('category',$categoryarray)
        ->where(['status'=>'1'])
        ->where('Total_no_of_product' ,'>', 0)
        ->get()->toArray();
        return view('shop',['categories'=>$categories,'products'=>$products,'categoryarray'=> $categoryarray]);
        }
        else{
            $categories=categorymodel::select('*')->where(['status'=>1])->get()->toArray();
            $products=ALLproducts::select('*')
            ->where(['status'=>'1'])
            ->where('Total_no_of_product' ,'>', 0)
            ->get()->toArray();
        }
        return view('shop',['categories'=>$categories,'products'=>$products]);
    }
}
