

<?php $__env->startSection('title','Brand List'); ?>
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <main id="main">
    <div class="row m-0">  
    <?php echo $__env->make('partials/_sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="main-content p-3">
          <h5 class="title">Brand List</h5>
          <div class="table-responsive">
            <table class="table data-table">
              <thead>
                <tr>
                  <th scope="col">no</th>
                  <th scope="col">Brand</th>
                  <th scope="col">Detail</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
    </div>
  </main><!-- End #main -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('backtop'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
        ajax: "<?php echo e(route('brandlist.index')); ?>",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'brand', name: 'brand'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\toko\resources\views/brandlist.blade.php ENDPATH**/ ?>