@extends('main')

@section('title','Purchase List')
@section('style')

@endsection


@section('content')
  <main id="main">
    <div class="row m-0">  
    @include('partials/_sidenav')
      <div class="main-content p-3">
          <h5 class="title">Purchase List</h5>
          <div class="table-responsive">
            <table class="table data-table">
              <thead>
                <tr>
                  <th scope="col">no</th>
                  <th scope="col">Purchase ID</th>
                  <th scope="col">Items</th>
                  <th scope="col">Total</th>
                  <th scope="col">Detail</th>
                </tr>
              </thead>
            </table>
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
    $(function () {
    
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: false,
        ajax: "{{ route('purchaselist.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'purchase_id', name: 'purchase_id'},
            {data: 'items', name: 'items'},
            {data: 'grandtotal', name: 'total'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endsection
