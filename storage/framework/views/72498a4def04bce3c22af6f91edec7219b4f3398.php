

<?php $__env->startSection('title','Edit Category'); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <main id="main">
    <div class="row m-0"> 
      <?php echo $__env->make('partials/_sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="main-content p-3">
  		  <div class="card">
  			<form class="m-3" method="post" action="<?php echo e(url('editcategory')); ?>" enctype="multipart/form-data">
  			  <div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Edit Category</h2>
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
  			  	    	<label>Category Name</label>
  			  	    	<input class="form-control" type="text" name="category" value="<?php echo e($category->category); ?>">
  			  	    </div>
                </div>
  			  	<div class="col-lg-12">
  			    	<div class="form-group">
                	  <input class="form-control" type="hidden" name="id" value="<?php echo e($category->id); ?>">
  			  		  <button class="btn btn-primary">Submit</button>
  			    	</div>
  			  	</div>
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

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\toko\resources\views/editcategory.blade.php ENDPATH**/ ?>