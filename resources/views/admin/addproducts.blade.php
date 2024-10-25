@extends('admin.app')
@section('content')
@if(session('success'))
<div class="alert alert-successvw-25" role="alert">
    Product Added Successfully!!
  </div>
  @endif
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Product</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="products.html" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
                    <form  method="post" action="/productdata"  enctype="multipart/form-data">
                        @csrf

                        

					<div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title">Product Name</label>
                                                    <input type="text"  id="title" class="form-control" placeholder="Title" name="ProductName" value="{{ old('ProductName') }}">	
                                                    <span class="text-danger">
                                                    @error('ProductName')
                                                    {{$message}}
                                                    @enderror
                                                </span>
                                                </div>
                                               
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description" value="{{ old('description') }}">
                                                        {{ old('description') }}
                                                    </textarea>
                                                    <span class="text-danger">
                                                        @error('description')
                                                        {{$message}}
                                                        @enderror
                                                      </span>
                                                </div>
                                              
                                            </div>                                            
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Product Image</h2>								
                                        <div id="image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">    
                                               <input type="file" name="productImage"> 
                                               <span class="text-danger">
                                                @error('productImage')
                                                {{$message}}
                                                @enderror
                                              </span>	                                        
                                            </div>
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" name="Price" id="price" class="form-control" placeholder="Price" value="{{ old('Price') }}">
                                                    <span class="text-danger">
                                                        @error('Price')
                                                        {{$message}}
                                                        @enderror
                                                      </span>	
                                                </div>
                                            </div>
                                            <!-- <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="compare_price">Compare at Price</label>
                                                    <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                                    <p class="text-muted mt-3">
                                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                                    </p>	
                                                </div>
                                            </div>                                             -->
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Inventory</h2>								
                                        <div class="row">
                                            <!-- <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">	
                                                </div>
                                            </div> -->
                                            <!-- <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="barcode">Barcode</label>
                                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                                </div>
                                            </div>    -->
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <!-- <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox" id="track_qty" name="ProductsCount" checked>
                                                       	
                                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                                    </div> -->
                                                </div>
                                                <div class="mb-3">
                                                    <label for="sku">Product Quantity</label>
                                                    <input type="number" min="0" name="ProductsCount" id="qty" class="form-control" placeholder="Qty" value="{{ old('ProductsCount') }}">
                                                    <span class="text-danger">
                                                        @error('ProductsCount')
                                                        {{$message}}
                                                        @enderror
                                                      </span>		
                                                </div>
                                            </div>                                         
                                        </div>
                                    </div>	                                                                      
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Block</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>  -->
                                <div class="card">
                                    <div class="card-body">	
                                        <h2 class="h4  mb-3">Product category</h2>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="Category" id="category" class="form-control">
                                                <option value="">Select Category</option>
                                                <option value="Medicines">Medicines</option>
                                                <option value="SkinCare">Skin Care</option>
                                                <option value="BabyCare">Baby Care</option>
                                                <option value="OralCare">Oral Care</option>
                                            </select>
                                            <span class="text-danger">
                                                @error('Category')
                                                {{$message}}
                                                @enderror
                                              </span>	
                                        </div>
                                        <!-- <div class="mb-3">
                                            <label for="category">Sub category</label>
                                            <select name="sub_category" id="sub_category" class="form-control">
                                                <option value="">Mobile</option>
                                                <option value="">Home Theater</option>
                                                <option value="">Headphones</option>
                                            </select>
                                        </div> -->
                                    </div>
                                </div> 
                                <!-- <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product brand</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Apple</option>
                                                <option value="">Vivo</option>
                                                <option value="">HP</option>
                                                <option value="">Samsung</option>
                                                <option value="">DELL</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>  -->
                                <!-- <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Featured product</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>                                  -->
                            </div>
                        </div>
						
						<div class="pb-5 pt-3">
							<button class="btn btn-primary" type="submit">Create</button>
							<a href="products.html" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
                   
                    </form>
					<!-- /.card -->
				</section>
			@endsection