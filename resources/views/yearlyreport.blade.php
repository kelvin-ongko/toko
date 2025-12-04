@extends('main')

@section('title','Monthly Report')
@section('style')
@endsection


@section('content')
  <main id="main">
    <div class="row m-0"> 
      @include('partials/_sidenav')
      <div class="main-content p-3">
  		  <div class="card">
  			<form class="m-3" method="get" action="{{url('yearlyreport')}}" enctype="multipart/form-data">
			  <div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Yearly Report</h2>
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
  			  	    	<h4>Year</h4>
						<Select name="year" class="form-control select2">
							@foreach($years as $i)
								<option value="{{ $i->year }}">
									{{ $i->year }}
								</option>
							@endforeach
						</Select>
  			  	    	<!-- <input id="year" class="form-control" type="number" name="year" min="2020" max="2100"> -->
  			  	    </div>
                </div>
  			  	<div class="col-lg-12">
  			    	<div class="form-group">
  			  		  <button class="btn btn-primary">Submit</button>
  			    	</div>
  			  	</div>
				
			  </div>
  			</form>
			@if(isset($monthly))
			@php
				$value = 0;
				$valueprofit = 0;
			@endphp
			<div class="col-lg-12 mb-3">
				<h2> {{ $year }}</h2>
				<div class="row">
					<div class="col-lg-3">
						<h5>Month</h5>
					</div>
					<div class="col-lg-6">
						<h5>Total</h5>
					</div>
					<div class="col-lg-3">
						<h5>Profit</h5>
					</div>
  			  	</div>
				@foreach($monthly as $item)
				<div class="row">
					<div class="col-lg-3">
						<h5>{{ $item->month }}</h5>
					</div>
					<div class="col-lg-6">
						<h5>Rp. {{ number_format($item->grandtotal) }}</h5>
						@php
							$value += $item->grandtotal
						@endphp
					</div>
					<div class="col-lg-3">
						<h5>Rp. {{ number_format($item->profit) }}</h5>
						@php
							$valueprofit += $item->profit
						@endphp
					</div>
  			  	</div>
				@endforeach
				<div class="row">
					<div class="col-lg-3">
						<h5>Total</h5>
					</div>
					<div class="col-lg-6">
						<h5>Rp. {{ number_format($value) }}</h5>
					</div>
					<div class="col-lg-3">
						<h5>Rp. {{ number_format($valueprofit) }}</h5>
					</div>
  			  	</div>
				<div class="row">
					<div class="col-lg-9">
						<canvas id="myChart" height="200"></canvas>
					</div>
				</div>
			</div>
			@endif
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
<script type="text/javascript">
var year = new Date();document.write(year.getFullYear());
$("#year").val(year);
$(".select2").select2();

@if(isset($monthly))
const text = {!! json_encode($monthly) !!};
var xValues = [];
var yValues = [];
var zValues = [];
for (var i = 0; i < text.length; i++) {
    xValues[i] = text[i].month;
    yValues[i] = text[i].grandtotal;
    zValues[i] = text[i].profit;
}

const myChart = new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: true,
      lineTension: 0.1,
      backgroundColor: "rgba(0,0,255, 0.1)",
      borderColor: "rgba(0,0,255,1.0)",
      data: yValues,
	  label: "Grand Total",
    },
	{
      fill: true,
      lineTension: 0.1,
      backgroundColor: "rgba(0,255,0,0.1)",
      borderColor: "rgba(0,255,0,1.0)",
      data: zValues,
	  label: "Profit",
    }],
  },
  options: {
    interaction: {
      intersect: true,
      mode: 'index',
    },
	tooltips: {
      callbacks: {
          label: function(tooltipItem, data) {
              return tooltipItem.yLabel.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
          }
      }
  	}
  },
});
@endif
</script>
@endsection
