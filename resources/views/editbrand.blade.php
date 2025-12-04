@extends('main')

@section('title','Edit Brand')
@section('style')
@endsection


@section('content')
  <main id="main">
    <div class="row m-0"> 
      @include('partials/_sidenav')
      <div class="main-content p-3">
  		  <div class="card">
  			<form class="m-3" method="post" action="{{url('editbrand')}}" enctype="multipart/form-data">
  			  <div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Edit Brand</h2>
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
  			  	    	<label>Brand Name</label>
  			  	    	<input class="form-control" type="text" name="brand" value="{{ $brand->brand }}">
  			  	    </div>
                </div>
  			  	<div class="col-lg-12">
  			    	<div class="form-group">
  			  		    <input class="form-control" type="hidden" name="id" value="{{ $brand->id }}">
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
