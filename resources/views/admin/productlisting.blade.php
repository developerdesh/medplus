@extends('admin.app')
@section('content')
   <!-- Main content -->
   <section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search" id="search">
    
                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">								
                <table class="table table-hover text-nowrap"  id="main">
                    <thead>
                        <tr>
                           
                            <th width="80">Product Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ALLproducts as $product)
                        <tr>
                           
                            <td><img src="{{asset($product->image)}}" class="img-thumbnail" width="150" ></td>
                            <td><a href="#">{{ $product->name }}</a></td>
                            <td>&#8377;{{ $product->price }}</td>
                            <td>{{$product->Total_no_of_product}}</td>
                           		@if($product->status==1)							
                            <td>
                                <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </td>
                            @else
                            <td>
                                <svg class="text-red-500 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" style="color:red!important">Online</path>
                                </svg>
                            </td>
                            @endif
                            <td>
                                <a href="/editproductpage/{{ $product->id }}">
                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <a href="/deleteproduct/{{$product->id}}" class="text-danger w-4 h-4 mr-1">
                                    <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                      </svg>
                                </a>
                            </td>
                           
                        </tr>
                        @endforeach
                        
                        
                        
                    </tbody>
                </table>	
               <!-- table 2  -->
               <table class="table table-hover text-nowrap" id="filter">
                <thead>
                    <tr>
                       
                      
											<th width="80">Product Image</th>
											<th>Product</th>
											<th>Price</th>
											<th>Qty</th>
											
										
											<th width="100">Action</th>
                      
                    </tr>
                </thead>
                <tbody id="product-results">
                   
                   
                 
                    
                    
                    
                </tbody>
            </table>	
               <!-- table 2  -->
            </div>
            <div class="card-footer clearfix">
                <ul class="pagination pagination m-0 float-right">
                    @if($page>1)
                  <li class="page-item"><a class="page-link" href="/productlisting/{{$page-1}}">Prev</a></li>
                  @endif
                  @if($page!=$pagecounter)
                  <li class="page-item"><a class="page-link" href="/productlisting/{{$page+1}}">Next</a></li>
                  @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
    @endsection
 @section('customjs')
 
 <script type="text/javascript">
    $(document).ready(function(){
        $('#filter').hide();  // Initially hide the filter table

        // Attach a keyup event to the search input
        $('#search').on('keyup', function() {
            var productName = $(this).val();

            // If the search input is empty, hide the filter table and show the main table
            if (productName === '') {
                $('#filter').hide();  // Hide filter table
                $('#main').show();    // Show main table
                return;  // Exit early to avoid making the AJAX call
            }

            // Make the AJAX call to fetch results
            $.ajax({
                url: "{{ route('searchedproduct') }}",  // Adjust this route if necessary
                method: "GET",
                data: { name: productName },
                success: function(response) {
                    // Clear the current product results
                    $('#product-results').html('');

                    // If there are results, display the filter table and hide the main table
                    if (response.length > 0) {
                        $('#filter').show();  // Show filter table
                        $('#main').hide();    // Hide main table
[]
                        $.each(response, function(index, product) {
                            var row = `
                                <tr>
                                    <td><img src="http://127.0.0.1:8000/${product.image}" class="img-thumbnail" width="150"></td>
                                    <td><a href="#">${product.name}</a></td>
                                    <td>&#8377;${product.price}</td>
                                    <td>${product.Total_no_of_product} left in Stock</td>
                                    <td>
                                        <a href="/editproductpage/${product.id}">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                            </svg>
                                        </a>
                                        <a href="/deleteproduct/${product.id}" class="text-danger w-4 h-4 mr-1">
                                            <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            `;

                            // Append the constructed row to the table
                            $('#product-results').append(row);
                        });
                    } else {
                        // If no products found, hide the filter table and show a message
                      
                        $('#product-results').html('<tr><td colspan="8">No products found</td></tr>');
                        $('#filter').hide();
                    }
                }
            });
        });
    });
</script>

@endsection

