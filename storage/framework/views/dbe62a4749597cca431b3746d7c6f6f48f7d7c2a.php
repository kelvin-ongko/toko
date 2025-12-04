

<?php $__env->startSection('title','Edit Item'); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <main id="main">
    <div class="row m-0"> 
      <?php echo $__env->make('partials/_sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="main-content p-3">
  		  <div class="card">
  			<form class="m-3" method="post" action="<?php echo e(url('edititem')); ?>" enctype="multipart/form-data">
			<div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Edit Item</h2>
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
  			  	    	<label>Name</label>
  			  	    	<input class="form-control" type="text" name="name" value="<?php echo e($item->name); ?>">
  			  	    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Brand</label>
                      <select id="brand" class="form-control" type="text" name="brand">
                        </select>
                    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Category</label>
                      <select id="category" class="form-control" type="text" name="category">
                        </select>
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Capital Price</label>
  			  	    	<input class="form-control" type="number" name="capitalprice" value="<?php echo e($item->capitalprice); ?>">
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Price</label>
  			  	    	<input class="form-control" type="number" name="price" value="<?php echo e($item->price); ?>">
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>QTY</label>
  			  	    	<input class="form-control" type="number" name="qty" value="<?php echo e($item->qty); ?>">
                    </div>
                </div>
  			  	<div class="col-lg-12">
  			    	<div class="form-group">
  			  	      <input class="form-control" type="hidden" name="id" value="<?php echo e($item->id); ?>">
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
<script>
$(document).ready(function(){
	var option = new Option("<?php echo e($brand->brand); ?>", "<?php echo e($brand->id); ?>");
	option.selected = true;

	$("#brand").append(option);
	$("#brand").trigger("change");

	
	var option2 = new Option("<?php echo e($category->category); ?>", "<?php echo e($category->id); ?>");
	option.selected = true;

	$("#category").append(option2);
	$("#category").trigger("change");
}) 

$('#brand').select2({
    placeholder: 'Select an item',
  	ajax: {
    	url: "<?php echo e(url('getbrands')); ?>",
    	dataType: 'json',
    	processResults: function (data) {
    	  return {
    	    results:  $.map(data, function (item) {
    	          return {
    	              text: item.brand,
    	              id: item.id
    	          }
    	      })
    	  };
    	},
        cache: true
  	}
});

$('#category').select2({
    placeholder: 'Select an item',
  	ajax: {
    	url: "<?php echo e(url('getcategories')); ?>",
    	dataType: 'json',
    	processResults: function (data) {
    	  return {
    	    results:  $.map(data, function (item) {
    	          return {
    	              text: item.category,
    	              id: item.id
    	          }
    	      })
    	  };
    	},
        cache: true
  	}
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\toko\resources\views/edititem.blade.php ENDPATH**/ ?>