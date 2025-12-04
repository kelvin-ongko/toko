

<?php $__env->startSection('title','Home'); ?>
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

  <main id="main">
    <div class="row m-0"> 
      <?php echo $__env->make('partials/_sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="main-content p-3">
        <div class="row">
          <div class="col-lg-4">
            <div class="card p-3">
              <h4>Today Transaction</h4>
              <h5><?php echo e($todaytransaction); ?></h5>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card p-3">
              <h4>Last 7 days Transaction</h4>
              <h5><?php echo e($last7daytransaction); ?></h5>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card p-3">
              <h4>This Month Transaction</h4>
              <h5><?php echo e($monthtransaction); ?></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><!-- End #main -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('backtop'); ?>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

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
        var url = '<?php echo e(url("/")); ?>';
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
        var url = '<?php echo e(url("/")); ?>';
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\toko\resources\views/home.blade.php ENDPATH**/ ?>