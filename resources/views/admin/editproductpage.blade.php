@extends('admin.app')
@section('content')

            <div class="container">
            <h1>Edit Product</h1>
            <form action="{{ url('updateproduct/' ) }}" method="POST" enctype="multipart/form-data">
                @csrf
               
                
                <!-- Product Name -->
                <input type="hidden" name="pid" value="{{$productdetail->id}}">
                <div class="form-group">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $productdetail->name }}" required>
                </div>
                
                <!-- Product Description -->
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" rows="4" required>{{ $productdetail->description }}</textarea>
                </div>
                
                <!-- Product Price -->
                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" class="form-control" value="{{ $productdetail->price }}" required>
                </div>
                
                <!-- Total Number of Products -->
                <div class="form-group">
                    <label for="total_no_of_product">Total Number of Products:</label>
                    <input type="number" id="total_no_of_product" name="total_no_of_product" class="form-control" value="{{ $productdetail->Total_no_of_product }}" required>
                </div>
                
                <!-- Product Sold -->
                <div class="form-group">
                    <label for="sold">Sold:</label>
                    <input type="number" id="sold" name="sold" class="form-control" value="{{ $productdetail->sold }}" required>
                </div>
                
                <!-- Product Status -->
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select id="status" name="status" class="form-control" required>
                        <option value="1" {{ $productdetail->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $productdetail->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                
                <!-- Product Category -->
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select id="category" name="category" class="form-control" required>
                        @foreach($categoryeditdata as $category)
                            <option value="{{ $category->cid }}" {{ $productdetail->category == $category->categoryname ? 'selected' : '' }}>
                                {{ $category->categoryname }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <!-- Product Image -->
                <div class="form-group">
                    <label for="image">Product Image:</label>
                    <input type="file" id="image" name="image" class="form-control">
                    <img src="{{ asset($productdetail->image) }}" alt="Product Image" style="max-width: 200px; margin-top: 10px;">
                </div>
                @error('image')
                <div class="text-danger" style="margin-top: 10px;">
                {{$message}}
                </div>
                @enderror
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        </div>
  
    
        @endsection