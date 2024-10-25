@include('header')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-3">
                    @include('account-panel')
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">My Orders</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead> 
                                        <tr>
                                            <th>Orders #</th>
                                            <th>Date Purchased</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($myorders_result))
@foreach($myorders_result as $myorders_results)
@php
$cartData = \App\Models\Cart::where('productID', $myorders_results['productID'])->get()->toArray();
@endphp
@if($cartData)
                                        <tr>
                                            <td>
                                                <a href="order-detail.php">OR756374</a>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($myorders_results['created_at'])->format('F d, Y') }</td>
                                            <td>
                                                @if($myorders_results['delivery_status']=='Pending')
          <span class="badge bg-success">Delivered</span>
          @endif

          @if($myorders_results['delivery_status']=='Deliverd')
          <span class="badge bg-success">Delivered</span>
          @endif

          @if($myorders_results['delivery_status']=='Accepted')
          <span class="badge bg-success">Delivered</span>
          @endif

          @if($myorders_results['delivery_status']=='Declined')
          <span class="badge bg-success">Delivered</span>
          @endif

          @if($myorders_results['delivery_status']=='Refunded')
          <span class="badge bg-success">Delivered</span>
          @endif

          @if($myorders_results['delivery_status']=='Out For Delivery')
          <span class="badge bg-success">Delivered</span>
          @endif
                                                
                                            </td>
                                            <td>&#8377;{{ $myorders_results['price'] }}</td>
                                        </tr>
                                                                           
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
@endif
@endforeach
@endif

@include('footer')