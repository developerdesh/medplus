@extends('admin.app')

@section('content')
<style>
    /* Basic styles */
   * {
       margin: 0;
       padding: 0;
       box-sizing: border-box;
       font-family: 'Poppins', sans-serif;
   }
   
   
   
   /* Container */
   .container {
       display: flex;
       height: 100vh;
   }
   
   /* Sidebar */
   
   /* Main Content */
   .main-content {
       flex: 1;
       padding: 30px;
       background-color: #fff;
       border-radius: 10px;
       margin: 20px;
       box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
   }
   
   /* Header */
   .header {
       display: flex;
       justify-content: space-between;
       align-items: center;
       margin-bottom: 40px;
   }
   
   .header h2 {
       font-size: 24px;
       color: #333;
   }
   
   .header p {
       font-size: 14px;
       color: #888;
   }
   
   .search-profile {
       display: flex;
       align-items: center;
   }
   
   .search-profile input {
       padding: 10px;
       margin-right: 20px;
       border: 1px solid #ddd;
       border-radius: 10px;
       width: 200px;
   }
   
   .search-profile .profile-pic {
       width: 40px;
       height: 40px;
       border-radius: 50%;
   }
   
   /* Profile Section */
   .profile-section {
       background: linear-gradient(90deg, rgba(255,255,255,1) 0%, rgba(241,246,254,1) 100%);
       padding: 20px;
       border-radius: 10px;
   }
   
   .profile-card {
       display: flex;
       justify-content: space-between;
       align-items: center;
       margin-bottom: 20px;
       background-color: #f5f7fb;
       padding: 20px;
       border-radius: 10px;
       box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
   }
   
   .profile-info {
       display: flex;
       align-items: center;
   }
   
   .profile-pic-lg {
       width: 70px;
       height: 70px;
       border-radius: 50%;
       margin-right: 20px;
   }
   
   .profile-details h3 {
       font-size: 20px;
       color: #333;
   }
   
   .profile-details p {
       font-size: 14px;
       color: #888;
   }
   
   .edit-btn {
       background-color: #007bff;
       color: white;
       border: none;
       padding: 10px 20px;
       border-radius: 5px;
       cursor: pointer;
   }
   
   .edit-btn:hover {
       background-color: #0056b3;
   }
   
   /* Form */
   .user-form .form-row {
       display: flex;
       justify-content: space-between;
       margin-bottom: 20px;
   }
   
   .form-group {
       flex: 1;
       margin-right: 20px;
   }
   
   .form-group:last-child {
       margin-right: 0;
   }
   
   .form-group label {
       font-size: 14px;
       color: #333;
       display: block;
       margin-bottom: 5px;
   }
   
   .form-group input {
       width: 100%;
       padding: 15px;
       border: 1px solid #ddd;
       border-radius: 10px;
       background-color: #f5f7fb;
   }
   
   .user-form select {
       width: 100%;
       padding: 15px;
       border: 1px solid #ddd;
       border-radius: 10px;
       background-color: #f5f7fb;
   }
   
   /* Email Section */
   .email-section {
       margin-top: 30px;
   }
   
   .email-section h4 {
       font-size: 16px;
       color: #333;
       margin-bottom: 10px;
   }
   
   .email-item {
       display: flex;
       align-items: center;
       margin-bottom: 15px;
       background-color: #f5f7fb;
       padding: 10px;
       border-radius: 10px;
   }
   
   .email-item img {
       width: 30px;
       height: 30px;
       margin-right: 10px;
   }
   
   .email-item p {
       margin: 0;
       color: #333;
       font-size: 14px;
   }
   
   .email-item small {
       display: block;
       color: #888;
   }
   
   .add-email-btn {
       background-color: #007bff;
       color: white;
       border: none;
       padding: 10px 20px;
       border-radius: 5px;
       cursor: pointer;
   }
   
   .add-email-btn:hover {
       background-color: #0056b3;
   }
   
   
   </style>
<div class="container w-75" style="height: 50%;">
    <!-- Sidebar -->
   

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        

       

            <!-- Form -->
            <form class="user-form" method="post" action="/newauserbackend">
                @csrf
                <input type="hidden" id="userid">
                <div class="form-row">
                    <!-- First column -->
                    <div class="form-group col-md-6">
                        <label for="email">Name</label>
                        <input type="text" id="role" class="form-control" placeholder="Name" name="name" required value="{{old('name')}}">
                        @error('role')
                        <span style="color:red!important">
                        {{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Email" name="email" required value="{{old('email')}}">
                        @error('email')
                        <span style="color:red!important">
                        {{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <!-- Second column -->
                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Password" name="pswd" required>
                        @error('pswd')
                        <span style="color:red">
                            {{$message}}
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirmpassword" class="form-control" placeholder="Confirm Password" name="cnfpswd" required>
                        <span class="mt-5" id="psdstaus"style="margin-top:5%!important;color:red;display:none">Password And Confirm Password Doesn't Match</span>
                    </div>
                </div>
                <div class="form-row">
                    <!-- Second column -->
                    <div class="form-group col-md-12 mt-5 w-50" style="width: 20%!important;">
                        <input type="submit" value="Submit" style="background-color: #007bff; color:#f5f7fb;width: 40%!important; margin-left: 28%!important;" id="submitbtn">
                    </div>
                </div>
            </form>
            
        </div>
    </div>

@endsection

@section('customjs')
<script>
$("#confirmpassword").on("input",function(){
var psd=$("#password").val();
var cnfpsd=$(this).val();
console.log("psd="+psd+"cnfpsd"+cnfpsd)
if(psd!=cnfpsd){
$('#psdstaus').show();
$('#submitbtn').css('cursor','not-allowed');
}
 if(psd==cnfpsd){
    $('#psdstaus').hide();
    $('#submitbtn').css('cursor','pointer');
}
if(!cnfpsd){
    $('#psdstaus').hide();
    
}  
// 

})

$("#password").on("input",function(){
var cnfpsd1=$("#confirmpassword").val();
var psd1=$(this).val();
console.log("cnfpsd1="+cnfpsd1+"psd1="+psd1)
if(psd1!=cnfpsd1){
$('#psdstaus').show();
$('#submitbtn').css('cursor','not-allowed');
}
 if(psd1==cnfpsd1){
    $('#psdstaus').hide();
    $('#submitbtn').css('cursor','pointer');
}
if(!cnfpsd1){
    $('#psdstaus').hide();
    
}  


})
</script>
@endsection