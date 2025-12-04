

<?php $__env->startSection('title','Admin Login'); ?>
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <main id="main">
  	<div class="login-center">	
  		<div class="col-xl-4 col-lg-6 col-md-8 col-xs-10 my-3">
  			<div class="card">
  				<form class="m-3" method="post" action="<?php echo e(url('login')); ?>">
  					<h2 class="title">Login</h2>
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
            <?php echo e(csrf_field()); ?>

  					<div class="form-group">
  						<label>Username</label>
  						<input class="form-control" type="text" name="username">
  					</div>
  					<div class="form-group">
  						<label>Password</label>
  						<input class="form-control" type="password" name="password">
  					</div>
  					<div class="form-group">
  						<button class="btn btn-primary">Submit</button>
  					</div>
  				</form>
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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\toko\resources\views/login.blade.php ENDPATH**/ ?>