@extends('main')

@section('title','Edit Item')
@section('style')
@endsection


@section('content')
  <main id="main">
    <div class="row m-0"> 
      @include('partials/_sidenav')
      <div class="main-content p-3">
  		  <div class="card">
  			<form class="m-3" method="post" action="{{url('edititem')}}" enctype="multipart/form-data">
			<div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Edit Item</h2>
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
  			  	    	<input class="form-control" type="text" name="name" value="{{ $item->name }}">
  			  	    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Brand</label>
                      <select id="brand" class="form-control" type="text" name="brand">
                        </select>
                    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Category</label>
                      <select id="category" class="form-control" type="text" name="category">
                        </select>
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Capital Price</label>
  			  	    	<input class="form-control" type="number" name="capitalprice" value="{{ $item->capitalprice }}">
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Price</label>
  			  	    	<input class="form-control" type="number" name="price" value="{{ $item->price }}">
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>QTY</label>
  			  	    	<input class="form-control" type="number" name="qty" value="{{ $item->qty }}">
                    </div>
                </div>
  			  	<div class="col-lg-12">
  			    	<div class="form-group">
  			  	      <input class="form-control" type="hidden" name="id" value="{{ $item->id }}">
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
<script>
$(document).ready(function(){
	var option = new Option("{{ $brand->brand }}", "{{ $brand->id }}");
	option.selected = true;

	$("#brand").append(option);
	$("#brand").trigger("change");

	
	var option2 = new Option("{{ $category->category }}", "{{ $category->id }}");
	option.selected = true;

	$("#category").append(option2);
	$("#category").trigger("change");
}) 

$('#brand').select2({
    placeholder: 'Select an item',
  	ajax: {
    	url: "{{url('getbrands')}}",
    	dataType: 'json',
    	processResults: function (data) {
    	  return {
    	    results:  $.map(data, function (item) {
    	          return {
    	              text: item.brand,
    	              id: item.id
    	          }
    	      })
    	  };
    	},
        cache: true
  	}
});

$('#category').select2({
    placeholder: 'Select an item',
  	ajax: {
    	url: "{{url('getcategories')}}",
    	dataType: 'json',
    	processResults: function (data) {
    	  return {
    	    results:  $.map(data, function (item) {
    	          return {
    	              text: item.category,
    	              id: item.id
    	          }
    	      })
    	  };
    	},
        cache: true
  	}
});
</script>
@endsection
