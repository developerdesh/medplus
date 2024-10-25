<div class="container-fluid">
    @include('frontend')
<form action="/editcategorybackend" method="post">
@csrf

<div class="form-group">
    <label for="recipient-name" class="col-form-label">Category Name:</label>
    <input type="hidden" name="cid" value="{{$categoryeditdata->cid}}">
    <input type="text" class="form-control" id="recipient-name" name="categoryname" value="{{$categoryeditdata->categoryname}}">
</div>
<div class="form-group">
    <label for="message-text" class="col-form-label">Status</label>
    <select name="status" id="" class="form-control">
        <option value="1" @if($categoryeditdata->status == 1) selected @endif>Live</option>
        <option value="0" @if($categoryeditdata->status == 0) selected @endif>Offline</option>
    </select>
</div>

<!-- HTML !-->
<br>
<button type="submit" class="button-15" role="button">Edit</button>
<style>
/* CSS */
.button-15 {
  background-image: linear-gradient(#42A1EC, #0070C9);
  border: 1px solid #0077CC;
  border-radius: 4px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  direction: ltr;
  display: block;
  font-family: "SF Pro Text","SF Pro Icons","AOS Icons","Helvetica Neue",Helvetica,Arial,sans-serif;
  font-size: 17px;
  font-weight: 400;
  letter-spacing: -.022em;
  line-height: 1.47059;
  min-width: 30px;
  overflow: visible;
  padding: 4px 15px;
  text-align: center;
  vertical-align: baseline;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  white-space: nowrap;
}

.button-15:disabled {
  cursor: default;
  opacity: .3;
}

.button-15:hover {
  background-image: linear-gradient(#51A9EE, #147BCD);
  border-color: #1482D0;
  text-decoration: none;
}

.button-15:active {
  background-image: linear-gradient(#3D94D9, #0067B9);
  border-color: #006DBC;
  outline: none;
}

.button-15:focus {
  box-shadow: rgba(131, 192, 253, 0.5) 0 0 0 3px;
  outline: none;
}

</style>
</form>
    @include('footer');
</div>