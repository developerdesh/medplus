@extends('admin.app')
@section('content')
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Orders</h1>
            </div>
            <div class="col-sm-6 text-right">
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    
           					
                <table class="table table-hover text-nowrap ml-2 mr-5" id="ticket-table">
                    <thead>
                        <tr>
                            <th>Order id</th>
                          
                            <th>User</th>
                            <th>ProductID</th>
                            <th>ProductName</th>
                            <th>Price</th>
                            <th>Product Quantity</th>
                            <th>Delivery address</th>
                            <th>Ordered On</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Manage Order Status</th> <!-- New header -->
                            <!-- Add other columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>										
           
            <!--  -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {
    $('#ticket-table').DataTable({
        paging: true,
        processing: true,
        serverSide: true,
        ordering: false,
        ajax: '/orderdetails',
        columns: [
            { data: 'id', name: 'id' },
          
            { data: 'name', name: 'name' },
            { data: 'productID', name: 'productID' },
            { data: 'productName', name: 'productName' },
            { data: 'price', name: 'price' },
            { data: 'total_no_of_product', name: 'total_no_of_product' },
            { data: 'delivery_address', name: 'delivery_address' },
            { data: 'created_at', name: 'created_at' },
            { data: 'status', name: 'Status' },
            { data: 'action', name: 'Action', orderable: false, searchable: false },
            { data: 'manage_order_status', name: 'Manage Order Status', orderable: false, searchable: false } // New column
           
           
        ],
    });
    $(document).on('mouseenter', '#tick', function () {
        $(this).prop('title', 'Accept Order');
    });
    $(document).on('mouseenter', '#cut', function () {
        $(this).prop('title', 'Decline Order');
    });
    $(document).on('mouseenter', '#delivered', function () {
        $(this).prop('title', 'Click If Delivered');
    });
   
});
</script>

<script>
    $(document).on('change','.manage-order-status',function(){ 
        var userID=$(this).data('user-id');
        var pid=$(this).data('product-id');
        var newstatus=$(this).val();
   
$.ajax({
url:'/updatenewstatus',
method:'POST',
data:{
    userID:userID,
    pid:pid,
    status:newstatus,
    _token: '{{ csrf_token() }}' // Add CSRF token if using Laravel

},
success:function(response){
    if(response.message==='S'){
    // alert('Status changed successfully');
   $('#ticket-table').DataTable().ajax.reload();
    }

    else{
        alert('Failed to update order status');
    }

},
error:function(xhr,status,error){
alert('Failed to update order status');
}
})
    

    });
</script>
            <!--  -->
          
       
    <!-- /.card -->
</section>
@endsection