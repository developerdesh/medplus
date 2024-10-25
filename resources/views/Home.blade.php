
@include('header')
<!-- header ends -->
<main>
    <section class="section-1">
        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- <img src="images/carousel-1.jpg" class="d-block w-100" alt=""> -->

                    <picture>
                       

                       
                        <img src="{{ asset('images/sliderimage2.png') }}" alt="" />
                    </picture>

                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3">
                            <h1 class="display-4 text-white mb-3">Shop Online at Flat 70% off on Medicines</h1>
                            <p class="mx-md-5 px-5">Lorem rebum magna amet lorem magna erat diam stet. Sadips duo stet amet amet ndiam elitr ipsum diam</p>
                            <a class="btn btn-outline-light py-2 px-4 mt-3" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
               
                
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-check text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Quality Product</h5>
                    </div>                    
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-shipping-fast text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">Free Shipping</h2>
                    </div>                    
                </div>
                <div class="col-lg-3">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-exchange-alt text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">14-Day Return</h2>
                    </div>                    
                </div>
                <div class="col-lg-3 ">
                    <div class="box shadow-lg">
                        <div class="fa icon fa-phone-volume text-primary m-0 mr-3"></div>
                        <h2 class="font-weight-semi-bold m-0">24/7 Support</h5>
                    </div>                    
                </div>
            </div>
        </div>
    </section>
    <section class="section-3">
        <div class="container">
            <div class="section-title">
                <h2>Categories</h2>
            </div>           
            <div class="row pb-3">
                @if(isset($categorymodel))
               
                @foreach($categorymodel as $category)
                <div class="col-lg-3">
                    <a href="" style="text-decoration: none; color: black;">
                    <div class="cat-card">
                        <div class="left">
                            @php 
                            $image='';
                            if($category['categoryname']=="Gym Supplements"){
                                $image = "images/fitnesscategory.webp";
                            }  
                            
                            elseif($category['categoryname']=="Medicine"){
                                $image = "images/medicinescategory.webp";
                            } 
                            elseif($category['categoryname']=="Mother And Baby Products"){
                                $image = "images/motherandbabycarecategory.webp";
                            } 
                            elseif($category['categoryname']=="Oral Care"){
                                $image = "images/oralcarecategory.webp";
                            }  
                            @endphp
                            <img src="{{ asset($image) }}" alt="" class="img-fluid">
                            
                        </div>
                        <div class="right">
                            <div class="cat-data">
                                <h2>{{$category['categoryname']}}</h2>
                                
                            </div>
                        </div>
                    </div>
                </a>
                </div>
            @endforeach
            @endif
            </div>
        </div>
    </section>
    
    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Featured Products</h2>
            </div>
            @if(isset($products))
            <div class="row pb-3">
            @foreach($products as $product)    
           
                <div class="col-md-3">
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="" class="product-img"><img class="card-img-top" src="{{ asset($product['image']) }}" alt=""></a>
                            <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                            <div class="product-action">
                                <a class="btn btn-dark" href="/addtocart/{{$product['id']}}">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>                            
                            </div>
                            <div class="product-action mt-5" style="margin-top: 60px!important">
                                <a class="btn btn-dark" href="/buynow/{{$product['id']}}">
                                    <i class="fa fa-shopping-bag"></i>Buy Now
                                </a>                            
                            </div>
                        </div>                        
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="/productdetails/{{$product['id']}}">{{$product['name']}}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>&#8377;{{$product['price']}}</strong></span>
                                <span class="h6 text-underline"><del>&#8377;{{$product['price']+50}}</del></span>
                            </div>
                        </div>                        
                    </div>                                               
                </div>  
                
        
        @endforeach
    </div>
        @endif
    </section>
    
    <section class="section-4 pt-5">
        <div class="container">
            <div class="section-title">
                <h2>Latest Products</h2>
            </div>
            @if(isset($latestproducts))
            <div class="row pb-3">
            @foreach($latestproducts as $product)    
           
                <div class="col-md-3">
                    <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="" class="product-img"><img class="card-img-top" src="{{ asset($product['image']) }}" alt=""></a>
                            <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                            <div class="product-action">
                                <a class="btn btn-dark" href="/addtocart/{{$product['id']}}">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>                            
                            </div>
                            <div class="product-action mt-5" style="margin-top: 60px!important">
                                <a class="btn btn-dark" href="/buynow/{{$product['id']}}">
                                    <i class="fa fa-shopping-bag"></i>Buy Now
                                </a>                            
                            </div>
                        </div>                        
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="/productdetails/{{$product['id']}}">{{$product['name']}}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>&#8377;{{$product['price']}}</strong></span>
                                <span class="h6 text-underline"><del>&#8377;{{$product['price']+50}}</del></span>
                            </div>
                        </div>                        
                    </div>                                               
                </div>  
                
        
        @endforeach
    </div>
        @endif
    </section>
</main>

<!-- footer starts -->
@include('footer')