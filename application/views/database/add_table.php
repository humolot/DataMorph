<?php $this->load->view('includes/header', array('title' => $title)) ?>

<div id="pjax-body">
	<div class="breadcrumb m-t">
		<li class="text-muted">
			<a href="<?php echo base_url("database/view?db=".$database) ?>" data-pjax>
				<i class="fa fa-database m-r-sm"></i><?php echo $database ?>
			</a>
			- New table
		</li>
		<a href="<?php echo base_url('http://localhost/datamorph/database/view?db='.$database) ?>">
			<button class="btn btn-sm btn-danger pull-right hover-text-warning m-l-sm" data-toggle="tooltip" data-placement="bottom" title="cancel">
				<i class="fa fa-close"></i>
			</button>
		</a>
		<div class="clearfix"></div>
	</div>

	<?php if (validation_errors()): ?>
		<div class="alert alert-danger m-a-0">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				<span class="sr-only">Close</span>
			</button>
			<?php echo validation_errors() ?>
		</div>
	<?php endif ?>
	<?php if (isset($feedback)): ?>
		<?php if ($feedback->type === "warning"): ?>
			<div class="alert alert-warning m-a-0">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<i class="fa fa-warning m-r-sm"></i> <?php echo $feedback->message ?>
			</div>
		<?php elseif ($feedback->type === "danger"): ?>
			<div class="alert alert-danger m-a-0">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<i class="fa fa-exclamation-circle m-r-sm"></i> <?php echo $feedback->message ?>
			</div>
		<?php endif ?>
	<?php endif ?>

	<?= form_open(current_url().'?target='.$database , array('class'=>'m-t-md')) ?>
	<?= form_hidden("database", $database) ?>

	<!-- tables fields -->
	<?php $this->load->view('create/table_fields'); ?>

	<div class="col-xs-6 text-right">
		<input type="submit" name="new_table" class="btn btn-primary" value="Add Table">
	</div>

	</div>

	<?= form_close() ?>

</div>

<?php $this->load->view('includes/footer') ?>