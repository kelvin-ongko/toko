

<?php $__env->startSection('title','Monthly Report'); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <main id="main">
    <div class="row m-0"> 
      <?php echo $__env->make('partials/_sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="main-content p-3">
  		  <div class="card">
  			<form class="m-3" method="get" action="<?php echo e(url('yearlyreport')); ?>" enctype="multipart/form-data">
			  <div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Yearly Report</h2>
  			  	</div>
  			  	<?php if(count($errors) > 0): ?>
  			  	<div class="col-lg-12">
  			  		<div class="alert alert-danger">
  			  			<ul>
  			  				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  			  				<li><?php echo e($error); ?></li>
  			  				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  			  			</ul>
  			  		</div>
  			  	</div>
  			  	<?php endif; ?>
  			  	<?php if(\Session::has('success')): ?>
  			  	<div class="col-lg-12">
  			  		<div class="alert alert-success">
  			  			<h3>	<?php echo e(\Session::get('success')); ?></h3>
  			  		</div>
  			  	</div>
  			  	<?php endif; ?>
  			  		<?php echo e(csrf_field()); ?>

                <div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<h4>Year</h4>
						<Select name="year" class="form-control select2">
							<?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($i->year); ?>">
									<?php echo e($i->year); ?>

								</option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
			<?php if(isset($monthly)): ?>
			<?php
				$value = 0;
				$valueprofit = 0;
			?>
			<div class="col-lg-12 mb-3">
				<h2> <?php echo e($year); ?></h2>
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
				<?php $__currentLoopData = $monthly; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-lg-3">
						<h5><?php echo e($item->month); ?></h5>
					</div>
					<div class="col-lg-6">
						<h5>Rp. <?php echo e(number_format($item->grandtotal)); ?></h5>
						<?php
							$value += $item->grandtotal
						?>
					</div>
					<div class="col-lg-3">
						<h5>Rp. <?php echo e(number_format($item->profit)); ?></h5>
						<?php
							$valueprofit += $item->profit
						?>
					</div>
  			  	</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<div class="row">
					<div class="col-lg-3">
						<h5>Total</h5>
					</div>
					<div class="col-lg-6">
						<h5>Rp. <?php echo e(number_format($value)); ?></h5>
					</div>
					<div class="col-lg-3">
						<h5>Rp. <?php echo e(number_format($valueprofit)); ?></h5>
					</div>
  			  	</div>
				<div class="row">
					<div class="col-lg-9">
						<canvas id="myChart" height="200"></canvas>
					</div>
				</div>
			</div>
			<?php endif; ?>
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
<script type="text/javascript">
var year = new Date();document.write(year.getFullYear());
$("#year").val(year);
$(".select2").select2();

<?php if(isset($monthly)): ?>
const text = <?php echo json_encode($monthly); ?>;
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
<?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\toko\resources\views/yearlyreport.blade.php ENDPATH**/ ?>