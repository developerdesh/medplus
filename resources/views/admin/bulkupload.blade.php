

@extends('admin.app')
@section('content')
<style>
#one
{
  margin-top:50px;
 box-shadow: 0px 0px 5px 2px rgba(0,0,0,0.2);
}
.it .btn-orange
{
  background-color: transparent;
  border-color: #777!important;
  color: #777;
  text-align: left;
  width:100%;
}
.it input.form-control
{
  height: 54px;
  border:none;
  margin-bottom:0px;
  border-radius: 0px;
  border-bottom: 1px solid #ddd;
  box-shadow: none;
}
.it .form-control:focus
{
  border-color: #ff4d0d;
  box-shadow: none;
  outline: none;
}
.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
.it .btn-new, .it .btn-next
{
  margin: 30px 0px;
  border-radius: 0px;
  background-color: #333;
  color: #f5f5f5;
  font-size: 16px;
  width: 155px;
}
.it .btn-next
{
  background-color: #ff4d0d;
  color: #fff;
}
.it .btn-check
{
  cursor:pointer;
  line-height:54px;
  color:red;
}
.it .uploadDoc
{
  margin-bottom: 20px;
}
.it .uploadDoc
{
  margin-bottom: 20px;
}
.it .btn-orange img {
    width: 30px;
}
p
{
  font-size:16px;
  text-align:center;
  margin:30px 0px;
}
.it #uploader .docErr
{
  position: absolute;
    right:auto;
    left: 10px;
    top: -56px;
    padding: 10px;
    font-size: 15px;
    background-color: #fff;
    color: red;
    box-shadow: 0px 0px 7px 2px rgba(0,0,0,0.2);
    display: none;
}
.it #uploader .docErr:after
{
  content: '\f0d7';
  display: inline-block;
  font-family: FontAwesome;
  font-size: 50px;
  color: #fff;
  position: absolute;
  left: 30px;
  bottom: -40px;
  text-shadow: 0px 3px 6px rgba(0,0,0,0.2);
}
.custom-file-input:focus + .custom-file-label {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.custom-file-label::after {
    content: "Browse";
    background-color: #007bff;
    color: white;
    border-left: 1px solid #ced4da;
    padding: 0.375rem 0.75rem;
}

.btn-primary {
    border-radius: 0;
    font-weight: bold;
}

  .progress {
      height: 40px;
      position: relative;
      border-radius: 20px;
  }

  .progress-bar {
      line-height: 40px; /* Vertically centers the text */
      font-weight: bold;
      font-size: 1.2em;
  }

  .progress-bar::after {
      content: attr(aria-valuenow) '%';
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      color: #fff;
  }
</style>
<center><h6><a href="/downloaddemo">Download Demo File</a></h6></center>
 
<!--  -->
<center>
  <div style="margin-left: 20%;">
<form method="post" action="/uploadproductexcel" enctype="multipart/form-data">
  @csrf
<div class="container">
  <div class="row it">
  <div class="col-sm-offset-1 col-sm-10" id="one">
  <p>
  Please upload documents only in 'xlsx' format.
  </p><br>
  <div class="row">
    <div class="col-sm-offset-4 col-sm-4 form-group">
     <center><h3 class="text-center">Bulk Upload</h3></center> 
    </div><!--form-group-->
  </div><!--row-->
  <div id="uploader">
  <div class="row uploadDoc">
    <div class="col-sm-11">
      <div class="docErr">Please upload valid file</div><!--error-->
      <div class="fileUpload btn btn-orange">
        <img src="https://image.flaticon.com/icons/svg/136/136549.svg" class="icon">
        <span class="upl" id="upload">Upload document</span>
        <input type="file" class="upload up form-control" id="up" name="productexcelfile">
      </div><!-- btn-orange -->
    </div><!-- col-3 -->
    <div class="col-sm-1"><a class="btn-check"><i class="fa fa-times"></i></a></div><!-- col-1 -->
  </div><!--row-->
  </div><!--uploader-->
  <div class="text-center">
  
  <button type="submit" class="btn btn-next"><i class="fa fa-paper-plane"></i>Upload</button>
  </div>
  </div><!--one-->
  </div><!-- row -->
  </div><!-- container -->
</form>
</div>
</center>
<!--  -->


@if(isset($batch))
<center>
  <div class="container mt-5">
    <h1>Uploading Your File</h1>
  
    <div class="progress" role="progressbar" aria-label="Batch progress" aria-valuemin="0" aria-valuemax="100">
        <div id="progress-bar" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%">0%</div>
    </div>
  
    <p>Pending Products: <span id="pending-jobs">Loading...</span></p>
    <p>Uploaded Products: <span id="processed-jobs">Loading...</span></p>
    <p>Failed: <span id="failed-jobs">Loading...</span></p>
    <p id="status-message"></p>
  </div>
</center>


  
      
 
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script></center>
@endsection

@section('customjs')
<script>
  $(document).ready(function() {
  function updateProgress() {
      $.ajax({
          url: '{{ route("batch-progress", ["batchId" => $batch->id]) }}',
          type: 'GET',
          success: function(data) {
              if (data.isComplete) {
                  $('#progress-bar').css('width', data.progress + '%').text(data.progress + '%');
                  $('#pending-jobs').text(data.pendingJobs);
                  $('#processed-jobs').text(data.processedJobs);
                  $('#failed-jobs').text(data.failedJobs);
                  $('#status-message').text('All Products Uploaded Successfully');
              } else {
                  $('#progress-bar').css('width', data.progress + '%').text(data.progress + '%');
                  $('#pending-jobs').text(data.pendingJobs);
                  $('#processed-jobs').text(data.processedJobs);
                  $('#failed-jobs').text(data.failedJobs);
                  
                  // Continue polling if not complete
                  setTimeout(updateProgress, 1000);
              }
          },
          error: function(xhr) {
              console.error('Error fetching batch progress:', xhr);
          }
      });
  }

  // Start the progress update loop
  updateProgress();
});

</script>
@endif
@endsection

  