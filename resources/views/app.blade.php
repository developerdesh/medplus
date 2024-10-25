<!-- header starts -->
<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Medplus</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />

	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />
	

	<link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/slick.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/slick-theme.css')}}" />
	
    <link rel="stylesheet" type="text/css" href="{{asset('front-assets/css/style.css')}}" />

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body data-instant-intensity="mousedown">
<style>
    .search-dropdown {
        margin-top: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        background-color: #fff;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .search-dropdown h3 {
        font-size: 14px;
        color: #666;
        margin: 0 0 10px 0;
    }

    .dropdown-item {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #e0e0e0;
        color: #333;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .dropdown-item:last-child {
        border-bottom: none;
    }

    .dropdown-item:hover {
        background-color: #f7f7f7;
    }

    .dropdown-item::after {
        content: '>';
        color: #999;
    }
</style>
<div class="bg-light top-header">        
	<div class="container">
		<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
			<div class="col-lg-4 logo">
				<a href="/" class="text-decoration-none">
					<span class="h1 text-uppercase text-primary bg-dark px-2">MED</span>
					<span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">PLUS</span>
				</a>
			</div>
			<div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
				<a href="account.php" class="nav-link text-dark">Search a product</a>
				<form action="">					
					<div class="input-group">
						<input type="text" placeholder="Search For Products" class="form-control" aria-label="Amount (to the nearest dollar)" id="searchproduct">
						<span class="input-group-text">
							<i class="fa fa-search"></i>
					  	</span>
					</div>
				</form>
			</div>		
            <div class="search-dropdown" id="productlist" style="display: none;">  <h3>Frequently Searched Items</h3></div>
		</div>
	</div>
</div>
<!--  -->
<script>
    $(document).ready(function(){
        $('#searchproduct').keyup(function(){

           
            var query =$(this).val();
            if(query !=''){
                $.ajax({
                    url:'/searched_item',
                    method:"POST",
                    data:{
                        query:query,
                        _token: '{{ csrf_token() }}'

                    },
                    success:function(data){
                         $('#productlist').fadeIn();
                         $('#productlist').html(data);
                    }
                });
            }
            else {
            $('#productlist').fadeOut();
            $('#productlist').html('');
            $('#productlist').hide();
        }
        })
    }
                  
    )
</script>
<!--  -->
<header class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand-xl" id="navbar">
            <a href="/" class="text-decoration-none mobile-logo">
                <span class="h2 text-uppercase text-primary bg-dark">MED</span>
                <span class="h2 text-uppercase text-white px-2">PLUS</span>
            </a>
            <button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="navbar-toggler-icon fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Dropdown items -->

                    <li class="nav-item dropdown">
                       <a href="/shop"> <button class="btn btn-dark">
                           Shop
                        </button></a>
                        
                    </li>


                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Electronics
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item nav-link" href="#">Mobile</a></li>
                            <li><a class="dropdown-item nav-link" href="#">Tablets</a></li>
                            <li><a class="dropdown-item nav-link" href="#">Laptops</a></li>
                            <li><a class="dropdown-item nav-link" href="#">Speakers</a></li>
                            <li><a class="dropdown-item nav-link" href="#">Watches</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Men's Fashion
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">Shirts</a></li>
                            <li><a class="dropdown-item" href="#">Jeans</a></li>
                            <li><a class="dropdown-item" href="#">Shoes</a></li>
                            <li><a class="dropdown-item" href="#">Watches</a></li>
                            <li><a class="dropdown-item" href="#">Perfumes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Women's Fashion
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">T-Shirts</a></li>
                            <li><a class="dropdown-item" href="#">Tops</a></li>
                            <li><a class="dropdown-item" href="#">Jeans</a></li>
                            <li><a class="dropdown-item" href="#">Shoes</a></li>
                            <li><a class="dropdown-item" href="#">Watches</a></li>
                            <li><a class="dropdown-item" href="#">Perfumes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Appliances
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="#">TV</a></li>
                            <li><a class="dropdown-item" href="#">Washing Machines</a></li>
                            <li><a class="dropdown-item" href="#">Air Conditioners</a></li>
                            <li><a class="dropdown-item" href="#">Vacuum Cleaner</a></li>
                            <li><a class="dropdown-item" href="#">Fans</a></li>
                            <li><a class="dropdown-item" href="#">Air Coolers</a></li>
                        </ul>
                    </li>
					@if(!Auth::check())
                    <li class="nav-item">
                        <a class="btn btn-dark" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-dark" href="/signup">Signup</a>
                    </li>
					@endif
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <!-- Cart Icon -->
                <a href="/showcart" class="btn  d-flex align-items-center me-3">
                    <i class="fas fa-shopping-cart text-primary" style="font-size: 20px;"></i>
                </a>
                <!-- Avatar -->
				@if(Auth::check())
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp" class="rounded-circle" height="5" alt="Avatar" loading="lazy" style="height: 45px!important;"/>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/userdetails">My profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="/myorders">My Orders</a></li>
                        <li><a class="dropdown-item" href="/showcart">My Cart</a></li>
                        <li><a class="dropdown-item" href="/logoutuser">Logout</a></li>
                    </ul>
                </div>
				<span style="color:white">{{ Auth::user()->name}}</span>
				@endif
            </div>
        </nav>
    </div>
</header>
<main>
    @yield('content')
</main>
<!-- header ends -->

<!-- footer starts -->
<!-- footer starts -->
<!-- footer starts -->
<footer class="bg-dark mt-5">
	<div class="container pb-5 pt-3">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-card">
					<h3>Get In Touch</h3>
					<p>No dolore ipsum accusam no lorem. <br>
					123 Street, New York, USA <br>
					exampl@example.com <br>
					000 000 0000</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>Important Links</h3>
					<ul>
						<li><a href="about-us.php" title="About">About</a></li>
						<li><a href="contact-us.php" title="Contact Us">Contact Us</a></li>						
						<li><a href="#" title="Privacy">Privacy</a></li>
						<li><a href="#" title="Privacy">Terms & Conditions</a></li>
						<li><a href="#" title="Privacy">Refund Policy</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>My Account</h3>
					<ul>
						<li><a href="#" title="Sell">Login</a></li>
						<li><a href="#" title="Advertise">Register</a></li>
						<li><a href="#" title="Contact Us">My Orders</a></li>						
					</ul>
				</div>
			</div>			
		</div>
	</div>
	<div class="copyright-area">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-3">
					<div class="copy-right text-center">
						<p>© Copyright 2022 Amazing Shop. All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- footer ends -->

</body>
</html>