

<?php $__env->startSection('title','Edit Transaction'); ?>
<?php $__env->startSection('style'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <main id="main">
    <div class="row m-0"> 
      <?php echo $__env->make('partials/_sidenav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="main-content p-3">
  		  <div class="card p-3">
			<!-- <form class="m-3" method="post" action="<?php echo e(url('detailtransaction')); ?>" enctype="multipart/form-data"> -->
			  <div class="row">
  			  	<div class="col-lg-12">
  			  		<h2 class="title">Transaction <?php echo e($transaction->transaction_id); ?></h2>
  			  	</div>
                <div class="col-lg-12 my-3">
  			  		<a class="btn btn-primary" href="<?php echo e(url('invoice/'.$transaction->transaction_id)); ?>">Invoice</a>
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
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Customer</label>
                      <input id="customer" class="form-control" type="text" name="customer" value="<?php echo e($transaction->customer); ?>" readonly require>
                    </div>
                </div>
  			  	<div class="col-lg-6">
                    <div class="form-group">
                      <label>Date</label>
                      <input id="date" class="form-control" type="date" name="date" value="<?php echo e($transaction->date); ?>" required>
                    </div>
                </div>
  			  	<div class="col-lg-6">
  			  	    <div class="form-group">
  			  	    	<label>Admin</label>
  			  	    	<input class="form-control" type="text" name="admin" value="<?php echo e($transaction->admin_id); ?>" readonly required>
                    </div>
                </div>

				<div class="col-lg-12 border">
					<div class="row">
						<div class="col-lg-1 pr-1">
							<h5>No</h5>
						</div>
						<div class="col-lg-5 px-1">
							<h5>Item</h5>
						</div>
						<div class="col-lg-1 px-1">
							<h5>Price</h5>
						</div>
						<div class="col-lg-1 px-1">
							<h5>Qty</h5>
						</div>
						<div class="col-lg-1 px-1">
							<h5>Disc %</h5>
						</div>
						<div class="col-lg-2 px-1">
							<h5>Total</h5>
						</div>
					</div>
					<div class="list-item">
                     <div hidden><?php echo e($i=1); ?> </div>
					<?php $__currentLoopData = $transactiondetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

					  <div class="row items-set">
						<div class="col-lg-1 pr-1">
							<h6> <?php echo e($i++); ?> </h6>
						</div>
						<div class="col-lg-5 px-1">
  			  	    		<div class="form-group">
  			  	    			<input class="form-control" type="text" name="item[]" value="<?php echo e($item->name); ?>"  readonly>
                    		</div>
						</div>
						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<input class="form-control price" type="text" name="price[]" value="<?php echo e($item->price); ?>">
                    		</div>
						</div>
						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<input class="form-control qty" type="number" name="qty[]" value="<?php echo e($item->qty); ?>" readonly>
                    		</div>
						</div>
						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<input class="form-control disc" type="number" min="0" max="100" step=".1" name="discount[]" value="<?php echo e($item->discount); ?>" >
                    		</div>
						</div>
						<div class="col-lg-2 px-1">
  			  	    		<div class="form-group">
								<input class="form-control total" type="text" name="total[]" value="<?php echo e($item->total); ?>" readonly>
                    		</div>
						</div>
						<form method="post" action="<?php echo e(url('deletetransactiondetail')); ?>">
						<?php echo e(csrf_field()); ?>

						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<button type="submit" class="btn btn-danger" name="transactiondetail" value="<?php echo e($item->id); ?>">X</button>
                    		</div>
						</div>
						</form>
					  </div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				<div class="col-lg-12 mt-3">
					<div class="row">
						<div class="col-lg-10">
							<h5 class="float-right">Total</h6>
						</div>
						<div class="col-lg-2">
							<h5 id="total"><?php echo e($transaction->total); ?></h6>
						</div>
  			    	</div>
					<div class="row">
						<div class="col-lg-10">
							<h5 class="float-right">Discount %</h6>
						</div>
						<div class="col-lg-2">
  			  	    		<div class="form-group">
							    <h5 id="discount" ><?php echo e($transaction->discount); ?></h6>
                    		</div>
						</div>
  			    	</div>
					<div class="row">
						<div class="col-lg-10">
							<h5 class="float-right">Grand Total</h6>
						</div>
						<div class="col-lg-2">
							<h5 id="grandtotal"><?php echo e($transaction->total); ?></h6>
						</div>
  			    	</div>
				</div>
  			  	<div class="col-lg-12 mt-3">
  			    	<!-- <div class="form-group">
  			  		  <button class="btn btn-primary">Submit</button>
  			    	</div> -->
				</div>
				<div class="col-lg-12 border">
					<div class="row">
						<div class="col-lg-1 pr-1">
							<h5>No</h5>
						</div>
						<div class="col-lg-5 px-1">
							<h5>Item</h5>
						</div>
						<div class="col-lg-2 px-1">
							<h5>Price</h5>
						</div>
						<div class="col-lg-1 px-1">
							<h5>Qty</h5>
						</div>
						<div class="col-lg-1 px-1">
							<h5>Disc %</h5>
						</div>
						<div class="col-lg-2 px-1">
							<h5>Total</h5>
						</div>
					</div>
					<form method="post" action="<?php echo e(url('edittransactiondetail')); ?>">
						<?php echo e(csrf_field()); ?>

					<div class="list-item">
					<?php for($i = 1; $i <= 50; $i++): ?>
					<!-- <?php echo e($i); ?> -->
					  <div class="row items-set">
						<div class="col-lg-1 pr-1">
							<h6> <?php echo e($i); ?> </h6>
						</div>
						<div class="col-lg-5 px-1">
  			  	    		<div class="form-group">
  			  	    			<Select class="form-control item" type="text" name="item[]">
								</select>
                    		</div>
						</div>
						<div class="col-lg-2 px-1">
  			  	    		<div class="form-group">
								<input class="form-control price" type="text" name="price[]" value="0">
								<input class="form-control capitalprice" type="hidden" name="capitalprice[]" value="0">
                    		</div>
						</div>
						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<input class="form-control qty" type="number" name="qty[]" value="0">
                    		</div>
						</div>
						<div class="col-lg-1 px-1">
  			  	    		<div class="form-group">
								<input class="form-control disc" type="number" min="0" max="100"  name="discount[]" value="0">
                    		</div>
						</div>
						<div class="col-lg-2 px-1">
  			  	    		<div class="form-group">
								<input class="form-control total" type="text" name="total[]" value="0" readonly>
                    		</div>
						</div>
					  </div>
					<?php endfor; ?>
					</div>
					<div class="col-lg-12 mt-3">
						<div class="form-group float-right">
							<button class="btn btn-primary">Add</button>
						</div>
					</div>
					</form>
				</div>
			  </div>
			<!-- </form> -->
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
	$('.item').select2({
    placeholder: 'Select an item',
  	ajax: {
    	url: "<?php echo e(url('getitems')); ?>",
    	dataType: 'json',
    	processResults: function (data) {
    	  return {
    	    results:  $.map(data, function (item) {
    	          return {
    	              text: item.namebrand,
    	              id: item.id
    	          }
    	      })
    	  };
    	},
        cache: true
  	}
});

// $('#mySelect2').on('select2:select', function (e) {
//     var data = e.params.data;
//     console.log(data);
// });
$('.item').change(function() {
	var qty = $(this).parents('.items-set').find('.qty');
	var price = $(this).parents('.items-set').find('.price');
	var capitalprice = $(this).parents('.items-set').find('.capitalprice');
	$.ajax({
       type:'GET',
       url:"<?php echo e(url('getitemprices')); ?>",
       data:"q="+$(this).val(),
       success:function(data) {
		qty.attr({
			"min" : 1,
			"max" : data.stok	
		})
		price.val(data.price) 
		capitalprice.val(data.capitalprice) 
       }
    });
});

function calculate(price, qty, disc){
	var total = (price * qty) - (price * qty * (disc /100));
	return total;
}

function grandtotal(){
	var sum = 0;
	$('.total').each(function(){
	    sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
	});
	var discount = $("#discount").val();
	var total = sum;
	var grandtotal = total - (sum * discount / 100);
	$("#total").text(sum);
	$("#totals").val(sum);
	$("#grandtotal").text(grandtotal);
	$("#grandtotal2").val(grandtotal);
}

$('.price').change(function() {
	var price = $(this).val()
	var qty = $(this).parents('.items-set').find(".qty").val();
	var disc = $(this).parents('.items-set').find(".disc").val();
	var total = calculate(price, qty, disc);;
	$(this).parents('.items-set').find(".total").val(total);
	grandtotal();
});

$('.qty').change(function() {
	var qty = $(this).val()
	var price = $(this).parents('.items-set').find(".price").val();
	var disc = $(this).parents('.items-set').find(".disc").val();
	var total = calculate(price, qty, disc);
	$(this).parents('.items-set').find(".total").val(total);
	grandtotal();
});

$('.disc').change(function() {
	var disc = $(this).val()
	var price = $(this).parents('.items-set').find(".price").val();
	var qty = $(this).parents('.items-set').find(".qty").val();
	var total = calculate(price, qty, disc);
	$(this).parents('.items-set').find(".total").val(total);
	grandtotal();
});

$('#totaldiscount').change(function() {
	grandtotal();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\toko\resources\views/edittransaction.blade.php ENDPATH**/ ?>