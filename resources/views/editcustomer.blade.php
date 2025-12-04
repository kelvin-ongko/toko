@extends('main')

@section('title','Edit Customer')
@section('style')
@endsection


@section('content')
  <main id="main">
    <div class="row m-0"> 
      @include('partials/_sidenav')
      <div class="main-content p-3">
  		  <div class="card">
  			<form class="m-3" method="post" action="{{url('editcustomer')}}" enctype="multipart/form-data">
			  <div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Edit Customer</h2>
  			  	</div>
  			  	@if(count($errors) > 0)
  			  	<div class="col-lg-12">
  			  		<div class="alert alert-danger">
  			  			<ul>
  			  				@foreach($errors->all() as $error)
  			  				<li>{{$error}}</li>
  			  				@endforeach
  			  			</ul>
  			  		</div>
  			  	</div>
  			  	@endif
  			  	@if(\Session::has('success'))
  			  	<div class="col-lg-12">
  			  		<div class="alert alert-success">
  			  			<h3>	{{ \Session::get('success') }}</h3>
  			  		</div>
  			  	</div>
  			  	@endif
  			  		{{csrf_field()}}
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Name</label>
  			  	    	<input class="form-control" type="text" name="name" value="{{ $customer->name }}">
  			  	    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input class="form-control" type="text" name="phonenumber" value="{{ $customer->phonenumber }}">
                    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Address</label>
                      <input class="form-control" type="text" name="address" value="{{ $customer->address }}">
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>City</label>
  			  	    	<input class="form-control" type="text" name="city" value="{{ $customer->city }}">
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Description</label>
  			  	    	<input class="form-control" type="text" name="description" value="{{ $customer->description }}">
                    </div>
                </div>
  			  	<div class="col-lg-12">
  			    	<div class="form-group">
                      <input class="form-control" type="hidden" name="id" value="{{ $customer->id }}">
  			  		  <button class="btn btn-primary">Submit</button>
  			    	</div>
  			  	</div>
			  </div>
			</form>
  		  </div>
      </div>
  	</div>
    

  </main><!-- End #main -->


@endsection

@section('footer')


@endsection

@section('backtop')

@endsection

@section('script')

@endsection
