
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Medplus</title>
  
  
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
   /* Sidebar styling */
   #sidebar {
            /* width: 250px; */
            background-color: #333;
            color: #fff;
            position: fixed;
            height: 100%;
            left: 0;
            top: 0;
            padding: 15px;
            transition: 0.3s ease;
        }

        /* Hidden sidebar */
        #sidebar.hidden {
            left: -250px;
        }

        /* Sidebar button */
        #sidebarBtn {
            margin-left: 20px;
            padding: 10px 15px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            position: absolute;
            top: 10px;
        }

        /* Sidebar options */
        .list-group-item {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            background-color: #333;
            border-bottom: 1px solid #444;
            transition: background-color 0.3s;
        }

        .list-group-item:hover {
            background-color: #444;
        }

        .list-group-item i {
            margin-right: 10px;
        }

        .list-group-item.active {
            background-color: #555;
        }

        #manageproducts_sub a {
            background-color: #714d69;
            margin-left: 15px;
        }

        /* Container for the main content */
        #mainContent {
            margin-left: 250px;
            padding: 4px;
            transition: 0.3s ease;
            width: calc(100% - 250px);
        }

        /* Main content when sidebar is hidden */
        #mainContent.fullWidth {
            margin-left: 0;
            width: 100%;
        }
</style>
@if(isset($userType) && $userType == 'admin')
@php $user_details=Auth::user();
@endphp
<!-- admin Sidebar -->
<div id="sidebar" class="" >
    <div class="list-group list-group-flush mx-3 mt-5">

      <a class="navbar-brand mt-2 mt-lg-0" href="/">
        <img
          src="{{ asset('images/logo.png') }}"
          height="60"
          alt="MDB Logo"
          loading="lazy"
        />
      </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>{{$user_details->name}}</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple active" id="manageproducts">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>Manage Products</span>
        </a>
        <!-- Sub manage product -->
        <span id="manageproducts_sub">
            <a href="/addproduct" class="list-group-item list-group-item-action py-2 ripple active" style="background-color:#714d69;">
                <i class="fa fa-plus fa-fw me-3"></i><span>Add Products</span>
            </a>
            <a href="/bulkupload" class="list-group-item list-group-item-action py-2 ripple active" style="background-color:#714d69;">
                <i class="fa fa-plus fa-fw me-3"></i><span>Product Bulk Upload</span>
            </a>
            <a href="/productlisting" class="list-group-item list-group-item-action py-2 ripple active" style="background-color:#714d69;">
                <i class="fa fa-pencil fa-fw me-3"></i><span>Product Listing</span>
            </a>
            <a href="/managecategory" class="list-group-item list-group-item-action py-2 ripple active" style="background-color:#714d69;">
                <i class="fa fa-eye fa-fw me-3"></i><span>Manage Categories</span>
            </a>
        </span>
        <!-- Sub manage product ends -->

        <a href="/userdetails" class="list-group-item list-group-item-action py-2 ripple active" id="manageproducts">
            <i class="fas fa-chart-area fa-fw me-3"></i><span>My Account</span>
        </a>
        <a href="/manageadmin" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-lock fa-fw me-3"></i><span>Manage Admin</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-chart-line fa-fw me-3"></i><span>Sales</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-chart-pie fa-fw me-3"></i><span>SEO</span>
        </a>
        <a href="/orders" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-headset fa-fw me-3"></i><span>Support</span>
        </a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-users fa-fw me-3"></i><span>Users</span></a>
        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
            <i class="fas fa-money-bill fa-fw me-3"></i><span>Sales</span></a>

            <a href="/logoutuser" class="list-group-item list-group-item-action py-2 ripple">
                <i class="fas fa-lock fa-fw me-3"></i><span>Logout</span>
            </a>
    </div>
</div>

@endif


@if(isset($userType) && $userType !='admin')
@php $user_details=Auth::user();
@endphp
@if(isset($user_details))
<div id="sidebar" class="mt-5" >
<div class="list-group list-group-flush mx-3 mt-5">
    <a href="#" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>{{$user_details->name}}</span>
    </a>
    @endif
    <a href="/userdetails" class="list-group-item list-group-item-action py-2 ripple active" id="manageproducts">
        <i class="fas fa-chart-area fa-fw me-3"></i><span>My Account</span>
    </a>
    <!-- Sub manage product -->
    <span id="manageproducts_sub">
        <a href="/myorders" class="list-group-item list-group-item-action py-2 ripple active" style="background-color:#714d69;">
            <i class="fa fa-plus fa-fw me-3"></i><span>My Orders</span>
        </a>
        <a href="/bulkupload" class="list-group-item list-group-item-action py-2 ripple active" style="background-color:#714d69;">
            <i class="fa fa-plus fa-fw me-3"></i><span>Notifications</span>
        </a>
        <a href="/showcart" class="list-group-item list-group-item-action py-2 ripple active" style="background-color:#714d69;">
            <i class="fa fa-pencil fa-fw me-3"></i><span>Cart</span>
        </a>
        <a href="/managecategory" class="list-group-item list-group-item-action py-2 ripple active" style="background-color:#714d69;">
            <i class="fa fa-eye fa-fw me-3"></i><span>Manage Categories</span>
        </a>
    </span>
    <!-- Sub manage product ends -->
    <a href="/logoutuser" class="list-group-item list-group-item-action py-2 ripple">
        <i class="fas fa-lock fa-fw me-3"></i><span>Logout</span>
    </a>
</div>
</div>
@endif

@if(!isset($userType))
<div id="sidebar" class="mt-5" >
<div class="list-group list-group-flush mx-3 mt-5">
    <a href="/login" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Login</span>
    </a>
    <a href="/signup" class="list-group-item list-group-item-action py-2 ripple active" id="manageproducts">
        <i class="fas fa-chart-area fa-fw me-3"></i><span>Signup</span>
    </a>
   
</div>
</div>
@endif
<!-- Button to open/close sidebar -->
<button id="sidebarBtn" style="margin-left:9%;position: -webkit-sticky; ">Close Sidebar</button>
<!-- search box starts -->


<script>
  // Get elements
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');
  const sidebarBtn = document.getElementById('sidebarBtn');

  // Toggle sidebar visibility
  sidebarBtn.addEventListener('click', function () {
      sidebar.classList.toggle('hidden');
      mainContent.classList.toggle('fullWidth');
      
      if (sidebar.classList.contains('hidden')) {
          sidebarBtn.textContent = 'Open Sidebar';
      } else {
          sidebarBtn.textContent = 'Close Sidebar';
      }
  });
</script>

<script>
  $(document).ready(function(){
    $("#manageproducts_sub").hide();
    $("#userprofile").click(function(){
      $("#userprofile_dropdown").toggle();
    });
    $("#manageproducts").click(function(){
 $("#manageproducts_sub").toggle();
    });
  });
  </script>