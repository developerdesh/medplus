@include('header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Orders</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-11" style="width: 100%!important;">
      <div class="container-fluid mt-5">
          <div class="row">
              <!-- <div class="col-md-3">
                  @include('account-panel')
              </div> -->
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header">
                          <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                      </div>
                      <div class="card-body p-4">
                          <div class="table-responsive">
                              <table class="table">
                                  <thead> 
                                      <tr>
                                          <th>Order Id #</th>
                                          <th>Product Name</th>
                                          <th>Date Purchased</th>
                                          <th>Status</th>
                                          <th>Total</th>
                                          <th>Product Quantity</th>
                                          <th>Delivery Address</th>
                                          <th>Return</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if(isset($myorders_result))
                                      @foreach($myorders_result as $myorders_results)
                                     
                                      <tr>
                                        
                                          <td>
                                              <a href="order-detail.php">{{$myorders_results['id']}}</a>
                                          </td>
                                          <td>{{$myorders_results['productName']}}</td>
                                          <td>{{ \Carbon\Carbon::parse($myorders_results['created_at'])->format('F d, Y') }}</td>
                                          <td>
                                              @if($myorders_results['status']=='Pending')
                                              <span class="badge bg-success">Pending</span>
                                              @endif
  
                                              @if($myorders_results['status']=='Deliverd')
                                              <span class="badge bg-success">Delivered</span>
                                              @endif
  
                                              @if($myorders_results['status']=='Accepted')
                                              <span class="badge bg-success">Accepted</span>
                                              @endif
  
                                              @if($myorders_results['status']=='Declined')
                                              <span class="badge bg-success">Declined</span>
                                              @endif
  
                                              @if($myorders_results['status']=='Refunded')
                                              <span class="badge bg-success">Refunded</span>
                                              @endif
  
                                              @if($myorders_results['status']=='Out For Delivery')
                                              <span class="badge bg-success">Out For Delivery</span>
                                              @endif
  
                                              @if($myorders_results['status']=='Returned')
                                              <span class="badge bg-danger">Returned</span>
                                              @endif
                                          </td>
                                          <td>&#8377;{{ $myorders_results['price'] }}</td>
                                          <td>{{ $myorders_results['total_no_of_product'] }}</td>
                                          <td>{{ $myorders_results['delivery_address'] }}</td>
                                          @if($myorders_results['status']=='Returned')
                                          <td><a style="color: red !important;">Returned</a></td>
                                          @else
                                          <td><a style="color: green !important;" href="/returnproduct/{{$myorders_results['id']}}">Return</a></td>
                                          @endif
                                      </tr>
                                    
                                      @endforeach    
                                      @endif                           
                                  </tbody>
                              </table>
                          </div>                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
  
</main>




@include('footer')