@extends('main')

@section('title','Register Admin')
@section('style')
@endsection


@section('content')
  <main id="main">
    <div class="row m-0"> 
      @include('partials/_sidenav')
      <div class="main-content p-3">
  		  <div class="card">
  			  <form class="m-3" method="post" action="{{url('registeradmin')}}" enctype="multipart/form-data">
  			  	<h2 class="title">Register Admin</h2>
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
  			  	    	<input class="form-control" type="text" name="name">
  			  	    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Email</label>
                      <input class="form-control" type="text" name="email">
                    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Username</label>
                      <input class="form-control" type="text" name="username">
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Password</label>
  			  	    	<input class="form-control" type="password" name="password">
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Confirm Password</label>
  			  	    	<input class="form-control" type="password" name="password_confirmation">
                    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Access</label>
                      <select class="form-control" type="text" name="access">
                        </select>
                    </div>
                </div>
  			    <div class="form-group">
  			  	  <button class="btn btn-primary">Submit</button>
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
