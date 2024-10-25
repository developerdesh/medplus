
@include('header')
<main>
  <section class="section-5 pt-3 pb-3 mb-3 bg-white">
      <div class="container">
          <div class="light-font">
              <ol class="breadcrumb primary-color mb-0">
                  <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                  <li class="breadcrumb-item"><a class="white-text" href="#">Shop</a></li>
                  <li class="breadcrumb-item">Cart</li>
              </ol>
          </div>
      </div>
  </section>
  
  <section class=" section-9 pt-4">
      <div class="container">
          <div class="row">
              <div class="col-md-8">
                @if(isset($products_incart) && !empty($products_incart))

                  <div class="table-responsive">
                      <table class="table" id="cart">
                          <thead>
                              <tr>
                                  <th>Item</th>
                                  <th>Price</th>
                                  <th>Quantity</th>
                                  <th>Total</th>
                                 <th></th>
                              </tr>
                          </thead>
                          <tbody>
                           
                            @php 
                            
                            $totalprice=0;
                            @endphp
                            @foreach($products_incart as $products_incarts)
                           
                              <tr>
                                  <td>
                                    <a href="/productdetails/{{$products_incarts['productID'] }}">
                                      <div class="d-flex align-items-center justify-content-center">
                                          <img src="{{asset($products_incarts['image'])}}" width="130x" height="130x" style="width: 50px!important;">
                                          <h2>{{$products_incarts['name']}}</h2>
                                      </div>
                                      </a>
                                  </td>
                                  <td>&#8377;{{$products_incarts['price']}}</td>
                                  <td>
                                      <div class="input-group quantity mx-auto" style="width: 100px;">
                                        @if($products_incarts == 1)
                                          <div class="input-group-btn">
                                              <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1">
                                                  <i class="fa fa-trash product_remove" aria-hidden="true" data-productid="{{ $products_incarts['productID'] }}"></i>
                                              </button>
                                          </div>
                                          @else
                                          <div class="input-group-btn">
                                            <button class="btn btn-sm btn-dark btn-minus p-2 pt-1 pb-1 product_minus" aria-hidden="true" data-productid="{{ $products_incarts['productID'] }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                          @endif
                                          <input type="text" class="form-control form-control-sm  border-0 text-center" value="{{ $products_incarts['no_of_product'] }}">
                                          <div class="input-group-btn">
                                              <button class="btn btn-sm btn-dark btn-plus p-2 pt-1 pb-1 product_plus" data-productid="{{ $products_incarts['productID'] }}">
                                                  <i class="fa fa-plus"></i>
                                              </button>
                                          </div>
                                      </div>
                                  </td>
                                  <td>
                                     <!-- total price starts-->
                                   @php $totalprice+=$products_incarts['price']*$products_incarts['no_of_product']; @endphp
                                     {{$products_incarts['price']*$products_incarts['no_of_product']}}

                                     <!-- total price ends -->
                                  </td>
                                  <td>
                                    <a href="/removeProduct/{{$products_incarts['id']}}"> <button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button></a>
                                    <a href="/buynow/{{$products_incarts['productID']}}"> <button class="btn btn-sm btn-success">Buy Now</button></a>
                                  </td>
                                  
                              </tr>
                             
                              @endforeach
                            
                            

                                                        
                          </tbody>
                      </table>
                  </div>
                 
              </div>
              <div class="col-md-4">            
                  <div class="card cart-summery">
                      <div class="sub-title">
                          <h2 class="bg-white">Cart Summery</h3>
                      </div> 
                      <div class="card-body">
                          <div class="d-flex justify-content-between pb-2">
                              <div>Subtotal</div>
                              <div>&#8377;{{$totalprice}}</div>
                          </div>
                          <div class="d-flex justify-content-between pb-2">
                              <div>Shipping</div>
                              <div>&#8377;{{20}}</div>
                          </div>
                          <div class="d-flex justify-content-between summery-end">
                              <div>Total</div>
                              <div>&#8377;{{$totalprice+20}}</div>
                          </div>
                          <div class="pt-5">
                              <a href="/allcartpayment/{{$totalprice}}" class="btn-dark btn btn-block w-100">Proceed to Checkout</a>
                          </div>
                      </div>
                  </div>     
                  <div class="input-group apply-coupan mt-4">
                      <input type="text" placeholder="Coupon Code" class="form-control">
                      <button class="btn btn-dark" type="button" id="button-addon2">Apply Coupon</button>
                  </div> 
              </div>
            
             
              
              @endif
              @if(isset($cartstatus) && $cartstatus==1)
              <img id="cart" src="{{ asset('images/emptycartpink.png') }}" alt="Empty Cart" width="200" style="width: 180%!important;margin-left: -13%!important;">

              @endif

          </div>
      </div>
  </section>

</main>
<!-- script for product handle starts -->
<script>
  $(document).ready(function(){
    // button remove product
//     $.ajaxSetup({
//   headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   }
// });

$(".product_remove").click(function(){
  var clickedElement = $(this); // To reference the clicked element inside AJAX callbacks
  var productID = clickedElement.data('productid');
  
  $.ajax({
    url: "{{ route('removeProduct', ['productID' => '__productID__']) }}".replace('__productID__', productID),
    method: 'POST',
    data: {
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      console.log(response);
      
      // Remove the corresponding element from the UI upon successful deletion
      clickedElement.closest('.cart_objects ').remove(); // Adjust this selector to match your structure
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
      // Handle errors here
    }
  });


})
// button minusproduct
$(document).on('click', '.product_minus', function() {
  console.log('Product minus clicked');
  var clickedElement = $(this); // To reference the clicked element inside AJAX callbacks
  var productID = clickedElement.data('productid');
  var productNoDiv = $('.product_no'); // Select the product_no div directly
  var no_of_product_span = productNoDiv.find('span'); // Find the span within product_no div

  $.ajax({
    url: "{{ route('minusProduct', ['productID' => '__productID__']) }}".replace('__productID__', productID),
    method: 'POST',
    data: {
      _token: $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(response) {
      console.log(response);
      if (response && response.productCOUNT >= 2) {
    if (parseInt(no_of_product_span.text()) > 1) {
        // var current_no_of_product = parseInt(no_of_product_span.text()); // Get the current value
        // var new_no_of_product = current_no_of_product - 1; // Decrement the value

        // // Update the data attribute and text content
        // productNoDiv.attr('data-no_of_product', new_no_of_product);
        // no_of_product_span.text(new_no_of_product);
        location.reload();
    }
}

if (response && response.productCOUNT == 1) {
    // var current_no_of_product = parseInt(no_of_product_span.text()); // Get the current value
    // var new_no_of_product = current_no_of_product - 1; // Decrement the value

    // Update the data attribute and text content
    // productNoDiv.attr('data-no_of_product', new_no_of_product);
    // no_of_product_span.text(new_no_of_product);

    // Update HTML content
    // newContent = '<i class="fa fa-trash product_remove2" aria-hidden="true" data-productid="' + productsIncartsProductID + '"></i>';
    // $('.less_product').html(newContent);
    location.reload();
}

      // Remove the corresponding element from the UI upon successful deletion
      // clickedElement.closest('.cart_objects ').remove(); // Adjust this selector to match your structure
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
      // Handle errors here
    }
  });
})
$(document).on("click", ".product_remove2", function() {
  var clickedElement = $(this); // To reference the clicked element inside AJAX callbacks
  var productID = clickedElement.data('productid');
  
  $.ajax({
    url: "{{ route('removeProduct', ['productID' => '__productID__']) }}".replace('__productID__', productID),
    method: 'POST',
    data: {
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      console.log(response);
      
      // Remove the corresponding element from the UI upon successful deletion
      clickedElement.closest('.cart_objects ').remove(); // Adjust this selector to match your structure
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
      // Handle errors here
    }
  });
});
// button add product
$(".product_plus").click(function(){
  var clickedElement = $(this); // To reference the clicked element inside AJAX callbacks
  var productID = clickedElement.data('productid');
  var productNoDiv = $('.product_no'); // Select the product_no div directly
  var no_of_product_span = productNoDiv.find('span'); // Find the span within product_no div
  $.ajax({
    url: "{{ route('addProduct', ['productID' => '__productID__']) }}".replace('__productID__', productID),
    method: 'POST',
    data: {
      _token: $('meta[name="csrf-token"]').attr('content')
    },
    success: function(response) {
      console.log(response);
      if (response && response.message3 === 'Product increased') {
        location.reload();
      }
      // Remove the corresponding element from the UI upon successful deletion
      // clickedElement.closest('.cart_objects ').remove(); // Adjust this selector to match your structure
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
      // Handle errors here
    }
  });
})
  });
</script>

<!-- script fot product handle ends -->
@include('footer')
