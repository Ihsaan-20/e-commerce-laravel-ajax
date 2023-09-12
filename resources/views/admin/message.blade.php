@if (Session::has('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
    <strong>{{Session::get('error')}}</strong>
  </div>
@endif

@if (Session::has('success'))
<div class="alert alert-success alert-dismissible">
    <strong>{{Session::get('success')}}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
    
  </div>
@endif

