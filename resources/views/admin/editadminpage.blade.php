@extends('admin.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                <form class="user-form">
                    <input type="hidden" id="userid" value="{{$userdata[0]['id']}}">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="country">Role</label>
                            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="name">
                                <option value="admin">Admin</option>
                                <option value="superadmin">Super Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nickname">Email</label>
                            <input type="email" id="email" placeholder="Email" value="{{$userdata[0]['email']}}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
  
    @endsection
    @section('customjs')
    <script>
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $('input ,select').on('blur change',function(){
            var userid=$('#userid').val();
            var inputvalue=$(this).val();
            var inputField =$(this).attr('id');
        $.ajax({
            url: '{{ route('editadminbackend') }}',
            method:'POST',
            data:{
                userid:userid,
                field:inputField,
                value:inputvalue
                
            },
           
        
        })
    });
    </script>
@endsection

