<?php  if (count($validation_errors) > 0) : ?>
	<div class="alert alert-danger" role="alert">
		<?php foreach ($validation_errors as $error) : ?>
			<p><?php echo $error ?></p>
		<?php endforeach ?>
	</div>
<?php  endif ?>
