@extends('main')

@section('title','Category List')
@section('style')

@endsection


@section('content')
  <main id="main">
    <div class="row m-0">  
    @include('partials/_sidenav')
      <div class="main-content p-3">
          <h5 class="title">Category List</h5>
          <div class="table-responsive">
            <table class="table data-table">
              <thead>
                <tr>
                  <th scope="col">no</th>
                  <th scope="col">Category</th>
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
        ajax: "{{ route('categorylist.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'category', name: 'category'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endsection
