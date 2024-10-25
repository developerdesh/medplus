
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('admin-assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">LARAVEL SHOP</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/showdashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>																
                </li>
                <li class="nav-item">
                    <a href="/managecategory" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/addproduct" class="nav-link">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <p>Add Products</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/bulkupload" class="nav-link">
                        <i class="fa fa-upload" aria-hidden="true"></i>

                        <p>Products Bulk Upload</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/productlisting" class="nav-link">
                        <i class="fa fa-list" aria-hidden="true"></i>

                        <p>Product Listing</p>
                    </a>
                </li>

                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <!-- <i class="nav-icon fas fa-tag"></i> -->
                        <i class="fas fa-truck nav-icon"></i>
                        <p>Shipping</p>
                    </a>
                </li>							
                <li class="nav-item">
                    <a href="/orders" class="nav-link">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>Orders</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/show-chart" class="nav-link">
                        <i class="fa fa-area-chart"></i>
                         <p>Orders Chart</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manageadmin/user" class="nav-link">
                        <i class="nav-icon  fas fa-users"></i>
                        <p>Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/manageadmin" class="nav-link">
                        <i class="fa fa-user" aria-hidden="true"></i>

                        <p>Manage Admin</p>
                    </a>
                </li>							
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
 </aside>
