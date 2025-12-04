@extends('main')

@section('title','Admin Login')
@section('style')

@endsection


@section('content')
  <main id="main">
  	<div class="login-center">	
  		<div class="col-xl-4 col-lg-6 col-md-8 col-xs-10 my-3">
  			<div class="card">
  				<form class="m-3" method="post" action="{{url('login')}}">
  					<h2 class="title">Login</h2>
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
            {{csrf_field()}}
  					<div class="form-group">
  						<label>Username</label>
  						<input class="form-control" type="text" name="username">
  					</div>
  					<div class="form-group">
  						<label>Password</label>
  						<input class="form-control" type="password" name="password">
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

