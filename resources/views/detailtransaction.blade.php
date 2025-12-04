@extends('main')

@section('title','Detail Transaction')
@section('style')
@endsection


@section('content')
  <main id="main">
    <div class="row m-0"> 
      @include('partials/_sidenav')
      <div class="main-content p-3">
  		  <div class="card">
			<form class="m-3" method="post" action="{{url('detailtransaction')}}" enctype="multipart/form-data">
			  <div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Transaction {{ $transaction->transaction_id }}</h2>
  			  	</div>
                <div class="col-lg-12 my-3">
  			  		<a class="btn btn-primary" href="{{url('invoice/'.$transaction->transaction_id)}}">Invoice</a>
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
                      <label>Customer</label>
                      <input id="customer" class="form-control" type="text" name="customer" value="{{ $transaction->customer }}" readonly require>
                    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Date</label>
                      <input id="date" class="form-control" type="date" name="date" value="{{ $transaction->date }}" required>
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Admin</label>
  			  	    	<input class="form-control" type="text" name="admin" value="{{ $transaction->admin_id }}" readonly required>
                    </div>
                </div>

				<div class="col-lg-12 border">
					<div class="row">
						<div class="col-lg-1 pr-1">
							<h5>No</h5>
						</div>
						<div class="col-lg-5 px-1">
							<h5>Item</h5>
						</div>
						<div class="col-lg-2 px-1">
							<h5>Price</h5>
						</div>
						<div class="col-lg-1 px-1">
							<h5>Qty</h5>
						</div>
						<div class="col-lg-1 px-1">
							<h5>Disc %</h5>
						</div>
						<div class="col-lg-2 px-1">
							<h5>Total</h5>
						</div>
					</div>
					<div class="list-item">
                     <div hidden>{{$i=1}} </div>
					@foreach ($transactiondetail as $item)

					  <div class="row items-set">
						<div class="col-lg-1 pr-1">
							<h6> {{ $i++ }} </h6>
						</div>
						<div class="col-lg-5 px-1">
  			  	    		<div class="form-group">
  			  	    			<input class="form-control item" type="text" name="item[]" value="{{ $item->name }}"  readonly>
                    		</div>
						</div>
						<div class="col-lg-2 px-1">
  			  	    		<div class="form-group">
								<input class="form-control price" type="text" name="price[]" value="{{ $item->price }}">
                    		</div>
						</div>
						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<input class="form-control qty" type="number" name="qty[]" value="{{ $item->qty }}" step=".1" readonly>
                    		</div>
						</div>
						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<input class="form-control disc" type="number" min="0" max="100"  name="discount[]" value="{{ $item->discount }}" >
                    		</div>
						</div>
						<div class="col-lg-2 px-1">
  			  	    		<div class="form-group">
								<input class="form-control total" type="text" name="total[]" value="{{ $item->total }}" readonly>
                    		</div>
						</div>
					  </div>
					@endforeach
					</div>
				</div>
				<div class="col-lg-12 mt-3">
					<div class="row">
						<div class="col-lg-10">
							<h5 class="float-right">Total</h6>
						</div>
						<div class="col-lg-2">
							<h5 id="total">{{ $transaction->total }}</h6>
						</div>
  			    	</div>
					<div class="row">
						<div class="col-lg-10">
							<h5 class="float-right">Discount %</h6>
						</div>
						<div class="col-lg-2">
  			  	    		<div class="form-group">
							    <h5 id="discount">{{ $transaction->discount }}</h6>
                    		</div>
						</div>
  			    	</div>
					<div class="row">
						<div class="col-lg-10">
							<h5 class="float-right">Grand Total</h6>
						</div>
						<div class="col-lg-2">
							<h5 id="grandtotal">{{ $transaction->total }}</h6>
						</div>
  			    	</div>
				</div>
  			  	<div class="col-lg-12 mt-3">
  			    	<!-- <div class="form-group">
  			  		  <button class="btn btn-primary">Submit</button>
  			    	</div> -->
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
