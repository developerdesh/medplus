
@extends('admin.app')
@section('content')
@if(session('newadminadded'))
<div class="alert alert-success" style="float: right;margin-right: 1%;
margin-top: -3%;" id="success-message">
{{session('newadminadded')}}
</div>
@endif


@if(session('newuseradded'))
<div class="alert alert-success" style="float: right;margin-right: 1%;
margin-top: -3%;" id="success-message">
{{session('newuseradded')}}
</div>
@endif

@if(session('userupdated'))
<div class="alert alert-success" style="float: right;margin-right: 1%;
margin-top: -3%;" id="success-message">
{{session('userupdated')}}
</div>
@endif

@if(session('userdeleted'))
<div class="alert alert-danger" style="float: right;margin-right: 1%;
margin-top: -3%;" id="success-message">
{{session('userdeleted')}}
</div>
@endif


@if(session('admindeleted'))
<div class="alert alert-danger" style="float: right;margin-right: 1%;
margin-top: -3%;" id="success-message">
{{session('admindeleted')}}
</div>
@endif


<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                @if(isset($usersdata))
                <h1>List of Users</h1>
                @else
                <h1>List Of Admins</h1>
                @endif
            </div>
            
           
            @if(isset($usersdata))
            <div class="col-sm-6 text-right">
                <a href="/addnewuser" class="btn btn-primary">Add User</a>
            </div>
            @else
            <div class="col-sm-6 text-right">
                <a href="/addnewadmin" class="btn btn-primary">Add Admin</a>
            </div>
            @endif
            
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                @if(isset($adminsdata))
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" id="admin">
    
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </div>
                @endif

                @if(isset($usersdata))
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" id="user">
    
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </div>
                @endif
            </div>
            <div class="card-body table-responsive p-0">								
                <table class="table table-hover text-nowrap" >
                    <thead>
                        <tr>
                            <th width="60">S.no</th>
                            <th>Name</th>
                            <th>Email</th>
                          
                            <th width="100">Actions</th>
                        </tr>
                    </thead>
                    @if(isset($adminsdata))
                    <tbody id="admintable">
                       
                      
                        @php $i=0;
                         $no=0; @endphp
                        @foreach($adminsdata as $admindata)
                        @php $no=$no+1; @endphp
                        <tr id="adminrow">
                            <td>
                               {{$no}}
                            </td>
                            <td>{{$adminsdata[$i]['name']}}</td>
                            <td>{{$adminsdata[$i]['email']}}</td>
                            <td>
                                <a href="/editadmin/{{$adminsdata[$i]['id']}}">
                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <a href="/deleteadmin/{{$adminsdata[$i]['id']}}" class="text-danger w-4 h-4 mr-1">
                                    <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                      </svg>
                                </a>
                            </td>
                        </tr>
                     @php $i++; @endphp
                       @endforeach
                    </tbody>
                       @endif

                       @if(isset($usersdata))
                       <tbody id="usertable">
                       @php $no=0; @endphp
                       @foreach($usersdata as $usersdatas)
                       @php $no=$no+1; @endphp
                       <tr id="userrow">
                           <td>
                              {{$no}}
                           </td>
                           <td>{{$usersdatas['name']}}</td>
                           <td>{{$usersdatas['email']}}</td>
                           <td>
                               <a href="/editusers/{{$usersdatas['id']}}">
                                   <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                       <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                   </svg>
                               </a>
                               <a href="/deleteuser/{{$usersdatas['id']}}" class="text-danger w-4 h-4 mr-1">
                                   <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                       <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                     </svg>
                               </a>
                           </td>
                       </tr>
                    
                      @endforeach




                    </tbody>
                       @endif
                    

                    
                </table>										
            </div>
            <div class="card-footer clearfix">
                <ul class="pagination pagination m-0 float-right">
                    @if(isset($usersdata))
                    @if(isset($page) && $page>0)
                    <li class="page-item"><a class="page-link" href="{{ route('manageadmin', ['no' => 'user', 'page' => $page-1]) }}">Prev</a></li>
                  @endif  
                  @if(isset($page) && $allpages>$page+1)
                
    <li class="page-item"><a class="page-link" href="{{ route('manageadmin', ['no' => 'user', 'page' => $page+1]) }}">Next</a></li>
@endif

@else
@if(isset($page) && $page>0)
<li class="page-item"><a class="page-link" href="{{ route('manageadmin', ['no' => 'admin', 'page' => $page-1]) }}">Prev</a></li>
@endif
@if(isset($page) && $allpages >$page+1)
<li class="page-item"><a class="page-link" href="{{ route('manageadmin', ['no' => 'admin', 'page' => $page+1]) }}">Next</a></li>
@endif
@endif

                </ul>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<meta name="csrf-token" content="{{ csrf_token() }}">
        @endsection

        @section('customjs')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Check if the success message exists
        if ($('#success-message').length) {
            // Fade out the message after 2 seconds
            setTimeout(function() {
                $('#success-message').fadeOut(500); // Fade out over 500 milliseconds
            }, 2000); // Wait for 2000 milliseconds (2 seconds)
        }
    });

    $("#admin").on('input',function(){
       
       var searched=$(this).val();
       if(searched === ""){
       location.reload();
      }
$.ajax({
    url:'/searchadmin',
    method:'Post',
    data:{
        _token: $('meta[name="csrf-token"]').attr('content'),
        type:1,
       name: searched
    },
    success:function(response){
        $('#admintable').html('');
        if (response.length > 0) {
            $('#adminrow').hide();
            $.each(response, function(index, product) {
                            var row = `
                            <tr>
                           <td>
                            ${index+1}
                           </td>
                           <td>${product.name}</td>
                           <td>${product.email}</td>
                           <td>
                               <a href="/editusers/${product.id}">
                                   <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                       <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                   </svg>
                               </a>
                               <a href="/deleteuser/${product.id}" class="text-danger w-4 h-4 mr-1">
                                   <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                       <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                     </svg>
                               </a>
                           </td>
                       </tr>`;
                            $('#admintable').append(row);
        });

    }
    else {
                        // If no products found, hide the filter table and show a message
                      
                        $('#admintable').html('<tr><td colspan="8">No admin found</td></tr>');
                       
                    }
    },
    error:function(){

    }
})
    })

    // for user

    $("#user").on('input',function(){
        var searched2=$(this).val();
      if(searched2 === ""){
       location.reload();
      }
       
$.ajax({
    url:'/searchuser',
    method:'Post',
    data:{
        _token: $('meta[name="csrf-token"]').attr('content'),
        type:2,
       name: searched2
    },
    success:function(response){
        $('#usertable').html('');
        if (response.length > 0) {
            $('#userrow').hide();
            $.each(response, function(index, product) {
                            var row2 = `
                            <tr>
                           <td>
                            ${index+1}
                           </td>
                           <td>${product.name}</td>
                           <td>${product.email}</td>
                           <td>
                               <a href="/editusers/${product.id}">
                                   <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                       <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                   </svg>
                               </a>
                               <a href="/deleteuser/${product.id}" class="text-danger w-4 h-4 mr-1">
                                   <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                       <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                     </svg>
                               </a>
                           </td>
                       </tr>`;
                            $('#usertable').append(row2);
        });

    }
    else {
                        // If no products found, hide the filter table and show a message
                      
                        $('#usertable').html('<tr><td colspan="8">No admin found</td></tr>');
                       
                    }
    },
    error:function(){

    }
})
    })
</script>
        @endsection

      