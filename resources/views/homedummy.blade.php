<div class="container-fluid" style="";>
    @include('frontend')
    
    @if(isset($userType) && $userType == 'admin')
        @include('admin.dashboard')
    @endif
    
    <style>
        
    
        .search-container {
          
            margin: 50px auto;
            position: relative;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    
        .search-container .title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    
        .search-bar {
            display: flex;
            align-items: center;
            border: 1px solid #d9d9d9;
            border-radius: 4px;
            padding: 8px;
            background-color: #f0f0f0;
        }
    
        .search-bar input {
            width: 100%;
            border: none;
            outline: none;
            background: none;
            font-size: 16px;
        }
    
        .search-bar input::placeholder {
            color: #999;
        }
    
        .search-bar svg {
            margin-left: 10px;
            width: 20px;
            height: 20px;
            fill: #999;
        }
    
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
    
    <style>
        ul.list-unstyled{
            background-color: #eee;
            cursor:pointer;
           
    
        }
        li{
            margin-top: 20px;
            padding:12px;
            font-size: 12px;
           
        }
    </style>
    <style>
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px; /* Adjust spacing between product boxes */
            margin: 20px;
        }
    
        .product-box {
            border: 1px solid #ccc;
            border-top-right-radius: 15px;
            width: calc(25% - 20px); /* Adjust width to fit four boxes in a row, considering the gap */
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Add margin at the bottom for rows */
        }
    
        .product-box img {
            width: 100%;
            border-top-right-radius: 15px;
        }
    
        .product-name {
            font-size: 18px;
            margin: 10px 0;
            font-weight: bold;
        }
    
        .mrp {
            font-size: 16px;
            color: #999;
            text-decoration: line-through;
        }
    
        .price {
            font-size: 20px;
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
    <style>
      .category-item {
          position: relative;
          overflow: hidden;
      }
    
      .category-item:hover img {
          transform: scale(1.1); /* Enlarge the image on hover */
          border-color: #84817a; /* Change the border color */
      }
    
      .category-item:hover h6 {
          background-color: #6ab04c; /* Change background color of text on hover */
          color: #fff; /* Change text color on hover */
          font-size: 22px;
      }
    </style>
    <div class="container mt-4 w-100">
        <img src="https://www.medibuddy.in/assets/banners/medicine-page.webp" alt="">
    </div>
    
    <!-- search box starts -->
    <div class="search-container container">
        <div class="title">Search for Medicines / Healthcare Products</div>
        <div class="search-bar">
            <input type="text"  name="search_items"  required id="searchproduct" placeholder="Search medicines/Healthcare products">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path d="M10,18a8,8,0,1,0-5.29-2.71l-5,5a1,1,0,0,0,1.42,1.42l5-5A8,8,0,0,0,10,18ZM4,10A6,6,0,1,1,10,16,6,6,0,0,1,4,10Z"/>
        </svg>
        </div>
          <div class="search-dropdown" id="productlist">  <h3>Frequently Searched Items</h3></div>
         
    </div>
    
    
    
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
            }
            })
        }
                      
        )
    </script>
    <!-- search box ends -->
    
    <!--  -->
    
    <div class="product-grid mt-5">
        @foreach($products as $data)
        
        <div class="product-box">
            <a href="/productdetails/{{$data['id']}}">
            <img src="{{ asset($data['image']) }}" alt="Product Image">
            <div class="product-name" style="color:#EAF0F1;font-weight: 700;font-size: 24px;border: 2px solid #487EB0;background-color: #487EB0;">{{$data['name']}}</div>
            <div class="mrp">MRP: &#8377;100.00</div>
            <div class="price" style="font-weight: 700;font-size: 24px;color:#192A56">&#8377;{{$data['price']}}</div>
        </a>
        </div>
    
        @endforeach
    </div>
    
    <!--  -->
    
    <!-- 4 products starts -->
    
    <h2 class="mt-5" style="margin-left: 3%;font-weight: 900;font-size: 30px;">Shop by Categories</h2>
    
     <!-- Categories -->
     <div class="row mt-5 ml-5" style="margin-left: 2%;">
      <div class="col-md-3 mb-4" style="width: 20%;">
        <a href="{{ route('category.products', ['category' => 'Medicines']) }}" class="text-decoration-none category-item">
            <img src="{{ asset('images/medicinescategory.webp') }}" class="img-thumbnail" alt="Medicines">
            <h6 class="text-center mt-2 border rounded-pill p-2" style="color:#192A56;width:86%">Medicines</h6>
        </a>
    </div>
      <div class="col-md-3 mb-4"  style="width: 20%;">
          <a href="{{ route('category.products', ['category' => 'SkinCare']) }}" class="text-decoration-none category-item">
              <img src="{{ asset('images/skincarecategory.webp') }}" class="img-thumbnail" alt="Skin Care">
              <h6 class="text-center mt-2 border rounded-pill p-2" style="color:#192A56;width:86%">Skin Care</h6>
          </a>
      </div>
      <div class="col-md-3 mb-4"  style="width: 20%;">
          <a href="{{ route('category.products', ['category' => 'BabyCare']) }}" class="text-decoration-none category-item">
              <img src="{{ asset('images/motherandbabycarecategory.webp') }}" class="img-thumbnail" alt="Baby Care">
              <h6 class="text-center mt-2 border rounded-pill p-2"style="color:#192A56;width:86%">Baby Care</h6>
          </a>
      </div>
      <div class="col-md-3 mb-4"  style="width: 20%;">
          <a href="{{ route('category.products', ['category' => 'OralCare']) }}" class="text-decoration-none category-item">
              <img src="{{ asset('images/oralcarecategory.webp') }}" class="img-thumbnail" alt="Oral Care">
              <h6 class="text-center mt-2 border rounded-pill p-2"style="color:#192A56;width:86%">Oral Care</h6>
          </a>
      </div>
    
      <div class="col-md-3 mb-4"  style="width: 20%;">
        <a href="{{ route('category.products', ['category' => 'OralCare']) }}" class="text-decoration-none category-item">
            <img src="{{ asset('images/fitnesscategory.webp') }}" class="img-thumbnail" alt="Oral Care">
            <h6 class="text-center mt-3 border rounded-pill p-2"style="color:#192A56;width:80%">Fitness Supplements</h6>
        </a>
    </div>
    </div>
    <!-- End of Categories -->
    <!-- New launches starts -->
    <!-- New lauches ends -->
    
    <script>
    </script>
    @include('footer');
    </div>