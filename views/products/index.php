<div>
	<?php if(isset($_SESSION['is_logged_in'])) : ?>
	<a class="btn btn-success btn-share" href="<?php echo ROOT_PATH; ?>products/add">Buy Something</a>
	<?php endif; ?>
	<?php foreach($viewmodel as $item) : ?>
		<div class="well">
			<h3><?php echo $item['item_name']; ?></h3>
			<small><?php echo $item['item_price']; ?></small>
			<hr />
			<p><?php echo $item['item_categories']; ?></p>
			<br />
			<a class="btn btn-default" href="<?php echo $item['link']; ?>" target="_blank">Go To Website</a>
		</div>
	<?php endforeach; ?>
</div>