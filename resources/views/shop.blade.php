@extends('app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
    <div class="container">
        <div class="light-font">
            <ol class="breadcrumb primary-color mb-0">
                <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                <li class="breadcrumb-item active">Shop</li>
            </ol>
        </div>
    </div>
</section>

<section class="section-6 pt-5">
    <div class="container">
        <div class="row">            
            <div class="col-md-3 sidebar">
               
                
               

                <div class="sub-title mt-5">
                    <h2>Categories</h3>
                </div>
                
            
                @if(isset($categories))
                        @foreach($categories as $category)
                <div class="card">
                    <div class="card-body">
                        <div class="form-check mb-2">
                            <input class="form-check-input brand-label" type="checkbox" name="category[]" value="{{$category['categoryname']}}" id="brand-{{$category['categoryname']}}">
                            <label class="form-check-label" for="brand-{{$category['categoryname']}}">
                                {{$category['categoryname']}}
                            </label>
                        </div>
                       
                                         
                    </div>
                </div>
                @endforeach
               
                @endif
                <div class="sub-title mt-5">
                    <h2>Price</h3>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                $0-$100
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                $100-$200
                            </label>
                        </div>                 
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                $200-$500
                            </label>
                        </div> 
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                $500+
                            </label>
                        </div>                 
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-end mb-4">
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">Sorting</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Price High</a>
                                        <a class="dropdown-item" href="#">Price Low</a>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
@if(isset($products))
@foreach($products as $product)
                    <div class="col-md-4">
                        <div class="card product-card">
                            <div class="product-image position-relative">
                                <a href="" class="product-img"><img class="card-img-top" src="{{asset($product['image'])}}" alt=""></a>
                                <a class="whishlist" href="222"><i class="far fa-heart"></i></a>                            

                                <div class="product-action">
                                    <a class="btn btn-dark" href="/addtocart/{{$product['id']}}">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>                            
                                </div>

                                <div class="product-action mt-5">
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
                   @endif

                    <div class="col-md-12 pt-5">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end">
                                <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(".brand-label").change(function(){
     apply_filters();
 });
 
 function apply_filters(){
     var brands = [];
     $(".brand-label").each(function(){
        if($(this).is(":checked")==true){
         brands.push($(this).val()); 
      } // Collect only checked items, and remove any extra spaces
     });  
     console.log(brands.toString());
     var url = '{{url()->current()}}?';
     window.location.href = url+'&categories='+brands.toString();
 }
 
 </script>
@endsection

