
@extends('admin.app')
@section('content')
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                        
                        <p class="mt-3"><i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 22px;"></i>
                            Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="/orders" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                       
                        <p class="mt-3"><i class="fa fa-users" aria-hidden="true" style="font-size: 22px;"></i>
                            Total Customers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="/manageadmin/user" class="small-box-footer text-dark">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner">
                       
                        <p class="mt-3"><i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 22px;"></i>Total Sale</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
                </div>
            </div>
        </div>
    </div>					
    <!-- /.card -->
    <!-- todays orders start -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-4 col-6">							
                <div class="small-box card">
                    <div class="inner" >
                        <h5>Today's Orders</h5>
                       
                        
                </div>
            </div>
        </div>
    </div>
</div>
    <!--  -->
</section>
@endsection('content')
@section('customjs')
<script>
    console.log("testing");
</script>
@endsection