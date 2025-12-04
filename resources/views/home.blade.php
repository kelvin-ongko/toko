@extends('main')

@section('title','Home')
@section('style')

@endsection


@section('content')

  <main id="main">
    <div class="row m-0"> 
      @include('partials/_sidenav')
      <div class="main-content p-3">
        <div class="row">
          <div class="col-lg-4">
            <div class="card p-3">
              <h4>Today Transaction</h4>
              <h5>{{ $todaytransaction }}</h5>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card p-3">
              <h4>Last 7 days Transaction</h4>
              <h5>{{ $last7daytransaction }}</h5>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card p-3">
              <h4>This Month Transaction</h4>
              <h5>{{ $monthtransaction }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><!-- End #main -->


@endsection

@section('footer')

@endsection

@section('backtop')
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
@endsection

@section('script')

<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

<script>
  $(function() {
    var getUrlParameter = function getUrlParameter(sParam) {
      var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

      for (i = 0; i < sURLVariables.length; i++) {
          sParameterName = sURLVariables[i].split('=');

          if (sParameterName[0] === sParam) {
              return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
          }
      }
      return false;
    };

    $(document).on("change", "#search", function() {

        //get url and make final url for ajax 
        var url = '{{url("/")}}';
        var append=  (getUrlParameter('page') != '') ? '?page='+ getUrlParameter('page')+"&" : '?';
        var finalURL = url + append + $("#searchform").serialize();

        //set to current url
        window.history.pushState({}, null, finalURL);

        $.get(finalURL, function(data) {

          $("#pagination_data").html(data);

        });

        return false;
      })

      $(document).on("click", "#pagination a", function() {

        //get url and make final url for ajax 
        var url = $(this).attr("href");
        var finalURL = url + "&" + $("#searchform").serialize();
        //set to current url
        window.history.pushState({}, null, finalURL);

        $.get(finalURL, function(data) {

          $("#pagination_data").html(data);

        });

        return false;
      })

      $(document).on("change", "input:radio[name=category]:checked", function() {

        //get url and make final url for ajax 
        var url = '{{url("/")}}';
        var append=  (getUrlParameter('page') != '') ? '?page='+ getUrlParameter('page')+"&" : '?';
        var finalURL = url + append + $("#searchform").serialize();

        //set to current url
        window.history.pushState({}, null, finalURL);

        $.get(finalURL, function(data) {
        
          $("#pagination_data").html(data);
        
        });

        return false;
      })

    });
</script>
@endsection
