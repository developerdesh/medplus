@extends('admin.app')
@section('content')

    <div id="mainContent" class="clearfix" style="margin-left: 2%;margin-right: 2%;">
        <!-- Button to trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
           Add New Category
        </button>
    <br><br>
        <!-- Modal -->
        <div class="modal" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/addcategory" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Category Name:</label>
                                <input type="text" class="form-control" id="recipient-name" name="categoryname">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">live</option>
                                    <option value="0">Offline</option>
                                </select>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    
        <!-- Model to edit category  -->
        <div class="modal" id="editcategorymodel" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cutbutton">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/addcategory" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Category Name:</label>
                                <input type="text" class="form-control" id="recipient-name" name="categoryname">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="1">live</option>
                                    <option value="0">Offline</option>
                                </select>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closebutton">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!--  -->
        <!-- DataTable -->
        <table id="products-table" class="display">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($allcategory))
                    @foreach($allcategory as $categories)
                        <tr>
                            <td>{{ $categories->categoryname }}</td>
                            <td><a href="/editcategory/{{ $categories->cid }}"><button class="btn btn-primary edit-button" id="editcategory" data-id="{{ $categories->cid }}">
                                <i class="fas fa-pencil-alt"></i> Edit
                            </button></a>
                            <a href="/deletecategory/{{$categories->cid}}"><button class="btn btn-danger delete-button" id="deletecategory" data-id="{{ $categories->cid}}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button></a>
                            </td>
                            <!-- Add your action buttons here if needed -->
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    @endsection('content')
    <!-- Initialize DataTable -->
    @section('customjs')
    <script>
        $(document).ready( function () {
            $('#products-table').DataTable(); // Initialize DataTables
        });
    </script>
    @endsection


   
