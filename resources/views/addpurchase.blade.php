@extends('main')

@section('title','Add Purchase')
@section('style')
@endsection


@section('content')
  <main id="main">
    <div class="row m-0"> 
      @include('partials/_sidenav')
      <div class="main-content p-3">
  		  <div class="card">
			<form class="m-3" method="post" action="{{url('addpurchase')}}" enctype="multipart/form-data">
			  <div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Purchase</h2>
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
                      <label>Date</label>
                      <input id="date" class="form-control" type="date" name="date" required>
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Admin</label>
  			  	    	<input class="form-control" type="text" name="admin" value="{{ Session::get('name') }}" readonly required>
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
					@for ($i = 1; $i <= 50; $i++)
					<!-- {{ $i }} -->
					  <div class="row items-set">
						<div class="col-lg-1 pr-1">
							<h6> {{ $i }} </h6>
						</div>
						<div class="col-lg-5 px-1">
  			  	    		<div class="form-group">
  			  	    			<Select class="form-control item" type="text" name="item[]">
								</select>
                    		</div>
						</div>
						<div class="col-lg-2 px-1">
  			  	    		<div class="form-group">
								<input class="form-control price" type="text" name="price[]" value="0">
								<input class="form-control capitalprice" type="hidden" name="capitalprice[]" value="0">
                    		</div>
						</div>
						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<input class="form-control qty" type="number" name="qty[]" value="0">
                    		</div>
						</div>
						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<input class="form-control disc" type="number" min="0" max="100"  name="discount[]" value="0">
                    		</div>
						</div>
						<div class="col-lg-2 px-1">
  			  	    		<div class="form-group">
								<input class="form-control total" type="text" name="total[]" value="0" readonly>
                    		</div>
						</div>
					  </div>
					@endfor
					</div>
				</div>
				<div class="col-lg-12 mt-3">
					<div class="row">
						<div class="col-lg-10">
							<h5 class="float-right">Total</h6>
						</div>
						<div class="col-lg-2">
							<h5 id="total">0</h6>
							<input id="totals" class="form-control" type="hidden" name="totals" value="0">
						</div>
  			    	</div>
					<div class="row">
						<div class="col-lg-10">
							<h5 class="float-right">Discount %</h6>
						</div>
						<div class="col-lg-2">
  			  	    		<div class="form-group">
								<input id="totaldiscount" class="form-control" type="number" min="0" max="100" name="totaldiscount" value="0">
                    		</div>
						</div>
  			    	</div>
					<div class="row">
						<div class="col-lg-10">
							<h5 class="float-right">Grand Total</h6>
						</div>
						<div class="col-lg-2">
							<h5 id="grandtotal">0</h6>
							<input id="grandtotal2" class="form-control" type="hidden" name="grandtotal" value="0">
						</div>
  			    	</div>
				</div>
  			  	<div class="col-lg-12 mt-3">
  			    	<div class="form-group">
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
var now = new Date();

var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);

var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
$('#date').val(today);

$('#customer').select2({
    placeholder: 'Select an customer',
  	ajax: {
    	url: "{{url('getcustomers')}}",
    	dataType: 'json',
    	processResults: function (data) {
    	  return {
    	    results:  $.map(data, function (item) {
    	          return {
    	              text: item.name+' - '+item.city,
    	              id: item.id,
    	          }
				
    	      })
    	  };
    	},
        cache: true
  	}
});

$('#customer').change(function() {
	$.ajax({
       type:'GET',
       url:"{{url('getcustomersname')}}",
       data:"q="+$(this).val(),
       success:function(data) {
		$('#customername').val(data.name)
       }
    });
});

$('.item').select2({
    placeholder: 'Select an item',
  	ajax: {
    	url: "{{url('getitems')}}",
    	dataType: 'json',
    	processResults: function (data) {
    	  return {
    	    results:  $.map(data, function (item) {
    	          return {
    	              text: item.namebrand,
    	              id: item.id
    	          }
    	      })
    	  };
    	},
        cache: true
  	}
});

// $('#mySelect2').on('select2:select', function (e) {
//     var data = e.params.data;
//     console.log(data);
// });
$('.item').change(function() {
	var qty = $(this).parents('.items-set').find('.qty');
	var price = $(this).parents('.items-set').find('.price');
	var capitalprice = $(this).parents('.items-set').find('.capitalprice');
	$.ajax({
       type:'GET',
       url:"{{url('getitemprices')}}",
       data:"q="+$(this).val(),
       success:function(data) {
		qty.attr({
			"min" : 1
		})
		price.val(data.capitalprice) 
		capitalprice.val(data.capitalprice) 
       }
    });
});

function calculate(price, qty, disc){
	var total = (price * qty) - (price * qty * (disc /100));
	return total;
}

function grandtotal(){
	var sum = 0;
	$('.total').each(function(){
	    sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
	});
	var discount = $("#totaldiscount").val();
	var total = sum;
	var grandtotal = total - (sum * discount / 100);
	$("#total").text(sum);
	$("#totals").val(sum);
	$("#grandtotal").text(grandtotal);
	$("#grandtotal2").val(grandtotal);
}

$('.price').change(function() {
	var price = $(this).val()
	var qty = $(this).parents('.items-set').find(".qty").val();
	var disc = $(this).parents('.items-set').find(".disc").val();
	var total = calculate(price, qty, disc);;
	$(this).parents('.items-set').find(".total").val(total);
	grandtotal();
});

$('.qty').change(function() {
	var qty = $(this).val()
	var price = $(this).parents('.items-set').find(".price").val();
	var disc = $(this).parents('.items-set').find(".disc").val();
	var total = calculate(price, qty, disc);
	$(this).parents('.items-set').find(".total").val(total);
	grandtotal();
});

$('.disc').change(function() {
	var disc = $(this).val()
	var price = $(this).parents('.items-set').find(".price").val();
	var qty = $(this).parents('.items-set').find(".qty").val();
	var total = calculate(price, qty, disc);
	$(this).parents('.items-set').find(".total").val(total);
	grandtotal();
});

$('#totaldiscount').change(function() {
	grandtotal();
});

</script>
@endsection
