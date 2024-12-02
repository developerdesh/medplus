<?php

namespace App\Http\Controllers;
use Razorpay\Api\Order;
use Throwable;
use App\Models\user;
use App\Models\myorders;
use Illuminate\Bus\Batch;
use App\Models\ALLproducts;
use App\Models\orderplaced;
use Illuminate\Http\Request;
use App\Models\categorymodel;
use App\Imports\ProductImport;
use App\Jobs\ImportProductsJob;
use App\Exports\BlankSheetExport;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\productsuploaded;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;


class Admincontroller extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function adminAUTH(Request $request){
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            
            // Authentication successful
            Auth::login($user);
    
            // Retrieve all notifications for the user
            $notifications = $user->notifications;
            $unreadNotifications = $user->unreadNotifications;

            // Pass the notifications to the view
            return view('admin.admindashboard', [
                'notifications' => $notifications,
                'unreadNotifications' => $unreadNotifications
            ]);
        } else {
            // Authentication failed
            return view('admin.login')->with(['error_login' => 'No Match Found']);
        }
    }
   
    public function showdashboard(){
       
        $totalamount=orderplaced::where(['status'=>'Deliverd'])->sum('price');
        $orderscount=orderplaced::select('*')->where(['status'=>'Deliverd'])->count();
        $todaysorderscount=orderplaced::select('*')->where(['created_at'=>now()])->count();
        $todaysorders=orderplaced::select('*')->where(['created_at'=>now()])->get()->toArray();
        $userscount=User::select('*')->whereNotIn('name',['admin','superadmin'])->count();
        return view('admin.admindashboard',['orderscount'=> $orderscount,'totalamount'=>$totalamount,'userscount'=>$userscount,'todaysorderscount'=> $todaysorderscount,'todaysorders'=> $todaysorders]);
    }
public function addproducts(){
    return view('admin.addproducts');
}
public function logout(){
    Auth::logout();
    return redirect('/');
}
public function productdata(Request $request){
    // $A=$request->file('productImage')->getClientOriginalName();
    $validate=$request->validate([
    'productImage'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    'Price'=>'required|numeric',
    'ProductName'=>'required',
    'description'=>'required',
    'ProductsCount'=>'required',
    'Category'=>'required'
    
    ]);
   
$image=$request->file('productImage');
$filename=uniqid().'.'.$image->getClientOriginalExtension();
$image->move(public_path('images/productImages'), $filename);
$ALLproducts=new ALLproducts();
$ALLproducts->name=$request->ProductName;
$ALLproducts->description=strip_tags($request->description);
$ALLproducts->image ='images/productImages/' .$filename;
$ALLproducts->category=$request->Category;
$ALLproducts->status='1';
$ALLproducts->price=$request->Price;
$ALLproducts->Total_no_of_product=$request->ProductsCount;
$ALLproducts->sold=0;
$ALLproducts->save();
return redirect()->route('addproduct')->with('success', 'Product added successfully!');
}
public function orders(){
    return view('admin/allorders');
}
public function orderdetails(){
    $orders = orderplaced::select('*')->get()->toArray();
    return DataTables::of($orders)
    ->addColumn('action', function ($orders) {
        if($orders['status']=="Out For Delivery"){
            return '<a class="btn btn-icon" href="/orderdelivered/'.$orders['userID'].'/'.$orders['productID'].'" style="margin-right:10px;color:white;font-weight:bolder;background-color:#575fcf" id="delivered"><i class="fas fa-shipping-fast" style="margin-right:2px"></i>Out For Delivery</i></a>' ;
        }

        elseif($orders['status']=="Pending"){
            return '<a class="btn btn-icon btn-success" href="/acceptorder/'.$orders['userID'].'/'.$orders['productID'].'" style="margin-right:3px" id="tick"><i class="fa fa-check"></i></a>' .
            '<a class="btn btn-icon btn-danger" href="/declineorder/'.$orders['userID'].'/'.$orders['productID'].'" id="cut"><i class="fa fa-times"></i></a>';
        }
        elseif($orders['status']=="Deliverd"){
            return '<a class="btn btn-icon  btn-success" style="margin-right:10px;color:white;font-weight:bolder;background-color:##eb2f06" ><i class="fas fa-check" style="margin-right:2px"></i>Successfull</i></a>' ;
        }

        elseif($orders['status']=="Declined"){
            return '<a class="btn btn-icon  btn-success" style="margin-right:10px;color:white;font-weight:bolder;background-color:red" ><i class="fa fa-times" style="margin-right:2px"></i>Declined</i></a>' ;
        }
        else{
            return '<a class="btn btn-icon  btn-success" style="margin-right:10px;color:white;font-weight:bolder;background-color:red" ><i class="fa fa-times" style="margin-right:2px"></i>'.$orders['status'].'</i></a>' ;
        }
       
    })
   
     ->addColumn('manage_order_status', function ($orders) {
            return '
                <select class="form-control manage-order-status w-100" data-user-id="' . $orders['userID'] . '" data-product-id="' . $orders['productID'] . '">
                    <option value="">Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Deliverd">Deliverd</option>
                    <option value="Accepted">Accepted</option>
                    <option value="Declined">Declined</option>
                    <option value="Refunded">Refunded</option>
                    <option value="Out For Delivery">Out For Delivery</option>
                </select>';
        })
        ->rawColumns(['action', 'manage_order_status']) // Mark the 'action' and 'manage_order_status' columns as raw HTML
    
    // Mark the 'action' column as raw HTML
    ->make(true);
}
public function acceptorder($userid,$productid){
    myorders::where(['userID'=>$userid,'productID'=>$productid])
    ->update(['delivery_status'=>'Out For Delivery']);
    orderplaced::where(['userID'=>$userid,'productID'=>$productid])
    ->update(['status'=>'Out For Delivery']);
    return back();

}

public function declineorder($userid,$productid){
myorders::where(['productID'=>$productid,'userID'=>$userid])->update(['delivery_status'=>'declined']);
orderplaced::where(['productID'=>$productid,'userID'=>$userid])->update(['status'=>'declined']);
return back();
}

public function orderdelivered($userid,$productid){
    myorders::where(['userID'=>$userid,'productID'=>$productid])
    ->update(['delivery_status'=>'Deliverd']);
    orderplaced::where(['userID'=>$userid,'productID'=>$productid])
    ->update(['status'=>'Deliverd']);
    return back();

}
public function productlisting($page=null){
$defaultvalue=1;
$pageno=$page?? $defaultvalue;
$limit=10;
$skip=($pageno-1)*10;
$totaldata=ALLproducts::count();
$pagecounter=ceil($totaldata / $limit);
$ALLproducts=ALLproducts::select('*')
->orderBy('id','asc')
->offset($skip)
->take($limit)
->get();  
return view('admin.productlisting',['ALLproducts'=>$ALLproducts,'page'=>$pageno,'pagecounter'=>$pagecounter]);
}

public function editproduct($pid){
$productdetail= ALLproducts::select('*')->where('id',$pid)->first();

return view('admin.editproductpage',compact('productdetail'));
}

public function deleteproduct($pid){
    ALLproducts::where('id',$pid)->delete();
  
    return redirect()->route('productlisting');
}


public function managecategory(){
$allcategory=categorymodel::select('*')->get();

return view('admin.managecategory',compact('allcategory'));
}

public function addcategory(Request $request){
    $category=new categorymodel();
    $category->categoryname=$request->categoryname ;
    $category->status=$request->status;
    $category->created_at=Now();
    $category->updated_at=Now();
    $category->save();
    return redirect()->route('managecategory')->with('success', 'Product added successfully!');
}

public function editcategory($cid){

$categoryeditdata=categorymodel::select('*')->where('cid' ,$cid)->first();

return view('admin.editcategory',compact('categoryeditdata'));

}

public function editcategorybackend(Request $request){

  
  categorymodel::where(['cid'=>$request->cid])
    ->update(['categoryname'=>$request->categoryname,'status'=>$request->status]);
   
 return redirect()->route('managecategory');
    
}

public function deletecategory($cid){

    categorymodel::where('cid', $cid)->delete();

    return redirect()->route('managecategory');

}

public function editproductpage($pid){
    $productdetail= ALLproducts::select('*')->where('id',$pid)->first();
    $categoryeditdata=categorymodel::select('*')->get();
    return view('admin.editproductpage',['productdetail'=> $productdetail,'categoryeditdata'=>$categoryeditdata]);
}

public function updateproduct(Request $request){
    $validate=$request->validate([
        'image'=>'mimes:jpg,jpeg,png|max:8192',
    ]);
    if($request->hasFile('image')){
        $file=$request->file('image');
        $filename=uniqid().$file->getClientOriginalName();
        $file->move(public_path('images/productImages'),$filename);
        ALLproducts::where(['id'=>$request->pid])
        ->update(['name'=>$request->name,'description'=>$request->description,'image' =>'images/productImages/'.$filename,'category'=>$request->category,'status'=>$request->status,'price'=>$request->price,'Total_no_of_product'=>$request->total_no_of_product,'sold'=>$request->sold,'updated_at'=> Now()]);
    }
    else{
        ALLproducts::where(['id'=>$request->pid])
        ->update(['name'=>$request->name,'description'=>$request->description,'category'=>$request->category,'status'=>$request->status,'price'=>$request->price,'Total_no_of_product'=>$request->total_no_of_product,'sold'=>$request->sold,'updated_at'=> Now()]);
    }
    
    return back();
}

function updatenewstatus(Request $request){

$request->validate([
    'userID'=>'required|integer',
    'pid'=>'required|integer',
    'status'=>'required'
]);   

$userid=$request->input('userID');
$pid=$request->input('pid');
$status=$request->input('status');

if($userid !==null && $pid !==null && $status !==null){
    
$orderplaced=orderplaced::where(['userID'=>$userid,'productID'=>$pid])->update(['status'=>$status]);
$myorders=myorders::where(['userID'=>$userid,'productID'=>$pid])->update(['delivery_status'=>$status]);

if($orderplaced >0 && $myorders>0){
    return response()->json(['message'=>'S']);
}
else{
    return response()->json(['message'=>'E']);
}

}

else{
    return response()->json(['message'=>'E']);
}

}

function bulkupload(){
    $batchId = request('batchId');
    // $notificationData=request('notificationData');
    // $unreadNotificationsCount=request('unreadNotificationsCount');
    if($batchId){
        $batch = Bus::findBatch($batchId);
        return view('admin.bulkupload',['batch'=>$batch]);
    }
    return view('admin.bulkupload');
}
function downloaddemo(){
    return Excel::download(new BlankSheetExport, 'demo.xlsx');
}

function uploadproductexcel(Request $request){
$request->validate([
'productexcelfile'=>'required|file|mimes:xlsx,xls',
]);

 // Dispatch the job to handle the import in the background
 $filePath = $request->file('productexcelfile')->store('uploads');
 $import = new ProductImport;
 Excel::import($import, $filePath);


$data = $import->data->toArray(); // Convert the collection to an array
$batch = Bus::batch([]) // Start an empty batch
    ->then(function (Batch $batch) {
        // This will be called when all jobs in the batch are processed successfully
        $user = Auth::user();  // Replace with the actual user ID
        $details = ['message' => 'Your job has been completed successfully.', 'completed_at' => now()];
        $user->notify(new productsuploaded($details)); // Send notification

        // Perform other actions on success, e.g., update status, etc.
    })
    ->catch(function (Batch $batch, Throwable $e) {
        // This will be called when any job in the batch fails
        $user = Auth::user();  // Replace with the actual user ID
        $details = ['message' => 'testing notifications.', 'completed_at' => now()];
        $user->notify(new productsuploaded($details)); // Send notification

        // Perform actions on failure, e.g., send notification, log error details, etc.
    })
    ->finally(function (Batch $batch) {
        // This will be called when the batch finishes (successfully or with failure)
        Log::info('Batch finished.', ['batch_id' => $batch->id]);

        // Perform final actions if needed
    })
    ->dispatch(); // Dispatch the batch // Start an empty batch

foreach ($data as $row) {
    $job = new ImportProductsJob([$row]);
    
    // Add the job to the batch
    $batch->add([$job]);
}

$user = Auth::user();  // Replace with the actual user ID
        $details = ['message' => 'Your job has been completed successfully.', 'completed_at' => now()];
        $user->notify(new productsuploaded($details)); // Send notification

        $user = Auth::user();

        // Get the most recent notification
        $latestNotification = $user->notifications->last();
        $unreadNotificationsCount = $user->unreadNotifications->count();
        if ($latestNotification) {
            $notificationData = $latestNotification->data; // Directly access the data
        } else {
            $notificationData = []; // Handle case where there are no notifications
        }

      session(['unreadNotificationsCount'=>$unreadNotificationsCount,
      'notificationData'=>$notificationData,
      ]);

      $sessionData = session()->all();

    // Print session data (this will appear in the server's log or output)
            // Pass the notification data to the view or redirect
        return redirect()->route('bulkupload', [
            'batchId' => $batch->id,
            'notificationData' => $notificationData,
            'unreadNotificationsCount' => $unreadNotificationsCount,
        ]);


}

public function showProgress(Request $request, $batchId){
    $batch = Bus::findBatch($batchId);

    if (!$batch) {
        return response()->json(['message' => 'Batch not found'], 404);
    }

    // Return batch progress as JSON
    return response()->json([
        'progress' => $batch->progress(),
        'pendingJobs' => $batch->pendingJobs,
        'processedJobs' => $batch->processedJobs(),
        'failedJobs' => $batch->failedJobs,
        'isComplete' => $batch->progress() >= 100
    ]);
   
}

public function batch(){
    $batchId=request('id');
    return Bus::findBatch($batchId);
}

public function notify(){
    $user = Auth::user();  // Replace with the actual user ID
    $details = ['message' => 'Test notification', 'completed_at' => now()];
    $user->notify(new productsuploaded($user));
    dd('sent');
}

public function manageadmin($no=null,$page=null){
  
    if($page==null){
        $page=0;
    }
    $limit=10;
    $skip=$page*$limit;
    if(isset($no) && $no=="user"){
        $userID=Auth::id();
        $usersdata=user::select('*')->where('name','!=','admin')
        ->where('name','!=','superadmin')
        ->offset($skip)
        ->limit($limit)
        ->get()
        ->toArray();
        $usersCount = User::select('*')->where('name','!=','admin')
        ->where('name','!=','superadmin')->count();
        $allpages=$usersCount/$limit;
        
        return view('admin.manageadmin', [
        'userID' => $userID,
        'usersdata'=>$usersdata,
        'usersCount'=>$usersCount,
        'page'=>$page,
        'allpages'=>$allpages
    
    ]); 
    }
    $userID=Auth::id();
    $adminsdata=user::select('*')->whereIn('name',['admin','superadmin'])
    ->offset($skip)
    ->limit($limit)
    ->get()->toArray();
    $adminsCount = User::whereIn('name', ['admin', 'superadmin'])->count();
    $allpages=$adminsCount/$limit;
    return view('admin.manageadmin', [
        'userID' => $userID,
        'adminsdata'=>$adminsdata,
        'adminsCount'=>$adminsCount,
        'page'=>$page,
        'allpages'=>$allpages
    
    ]);
}

public function editadmin($adminid){
$userdata=user::select('name','email','id')->where(['id'=>$adminid])->get()->toArray();
return view('admin.editadminpage',['userdata'=>$userdata]);
}

public function editadminbackend(Request $request){
user::where(['id'=>$request->userid])->update([$request->field => $request->value]);
return response()->json(true);
}

public function searchedproduct(Request $request){
$productname=$request->name;
$productname=$request->name;
$results = ALLproducts::where('name', 'LIKE', '%' . $productname . '%')->get();

return response()->json($results);
}

public function saleschart()
{
    // Fetch total products sold grouped by month for the year 2024
    $sales = OrderPlaced::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_no_of_product) as total_sold'))
        ->whereYear('created_at', 2024)
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->toArray();

    // Return the data in JSON format with proper keys
    return response()->json([
        'orders' => $sales  // Using 'orders' as the key to match the frontend expectations
    ]);
}

public function showchart(){
    return view('admin.chart');
}

public function addnewadmin(){
return view('admin.addnewadmin');

}

public function newadminbackend(Request $request){
          $request->validate([
            'role'=>'required',
            'email'=>'required|email|unique:users,email',
            'pswd'=>'required',
          ],[
            'email.unique'=>'The email address is already registered',
          ]);

          $createuser=new user();
          $createuser->name=$request->role;
          $createuser->email=$request->email;
          $createuser->password= bcrypt($request->pswd);
          $createuser->save();
          $user = User::where('email', $request->email)->first();
          if($user){
            session()->flash('newadminadded', 'New admin created successfully!!');
            return redirect('/manageadmin');
          }
          
}

public function addnewuser(){
return view('admin.addnewuser');
}

public function newauserbackend(Request $request){
    $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users,email',
        'pswd'=>'required',
      ],[
        'email.unique'=>'The email address is already registered',
      ]);

      $createuser=new user();
      $createuser->name=$request->name;
      $createuser->email=$request->email;
      $createuser->password= bcrypt($request->pswd);

      $createuser->save();
      $user = User::where('email', $request->email)->first();
      if($user){
        session()->flash('newuseradded', 'New user created successfully!!');
        return redirect('/manageadmin/user');
      }
}

public function editusers($userid){
   
$usereditdata=User::select('*')->where(['id'=>$userid])->first()->toArray();

return view('admin.edituser',['data'=>$usereditdata]);
}
public function editauserbackend(Request $request){
$updated=User::select('*')->where(['id'=>$request->userid])->update(['name'=>$request->name,'email'=>$request->email]);
if($updated){
session()->flash('userupdated', 'User updated successfully!!');
return redirect('/manageadmin/user');
}
}

public function deleteuser($userid){
    $deleteuser=User::where(['id'=>$userid])->delete();
    if($deleteuser){
        session()->flash('userdeleted', 'User deleted successfully!!');
        return redirect('/manageadmin/user'); 
    }
}

public function deleteadmin($userid){
    $deleteuser=User::where(['id'=>$userid])->delete();
    if($deleteuser){
        session()->flash('admindeleted', 'Admin deleted successfully!!');
        return redirect('/manageadmin'); 
    }
}

public function searchadmin(Request $request){
    if($request->type==1){
    $resultusers = User::where('name', 'LIKE', '%' . $request->name . '%')
    ->whereIn('name', ['admin', 'superadmin']) 
    ->get();
    return response()->json($resultusers);
    
    }
}


public function searchuser(Request $request){
    if($request->type==2){
    $resultusers = User::where('name', 'LIKE', '%' . $request->name . '%')
    ->whereNotIn('name', ['admin', 'superadmin']) 
    ->get();
    return response()->json($resultusers);
    
    }
}

}

