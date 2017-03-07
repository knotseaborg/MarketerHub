@if(session('success'))
    <div class="row">
        <div class="col-md-12 text-center alert-success">
          <h5>{{ session('success') }}</h5>
        </div>
    </div>
@endif
@foreach($errors->all() as $error)
    <div class="ro">
        <div class="col-md-12 text-center alert-danger">
          <h5>{{ $error }}</h5>
        </div>
      </div>
@endforeach