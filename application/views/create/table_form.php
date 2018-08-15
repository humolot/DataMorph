<?php $this->load->view('includes/header', array( 'title' => 'Create Database' )); ?>
<?php $this->load->view('create/create_header', array('database' => $database )); ?>

<?php if ($this->session->flashdata('error_msg')): ?>
	<div class="alert alert-danger">
		<?php echo $this->session->flashdata('error_msg') ?>
		<a href class="m-l" data-toggle="modal" data-target="#create-table">Edit Form</a>
	</div>
<?php endif ?>

<?php if ( ! $tables): ?>
	<div class="alert alert-warning">
		This database does not have any tables.
		<a href="#" data-toggle="modal" data-target="#create-table">Add some tables</a>
	</div>
<?php else: ?>
	<div class="card-columns">
		<?php foreach ($tables as $index => $table): ?>
			<div class="card table-tile hoverable">
				<div class="card-header">
					<label class="m-a-0"><?php echo $table['name'] ?></label>
					<div class="btn-group pull-right">
						<?php echo anchor('create/edit/'.$index, 
						'edit',
						array('class'=>'btn btn-xs btn-primary-outline', 'data-pjax'=>'')) ?>
						<?php echo anchor('create/delete_table/'.$index, 
						'delete',
						array('class'=>'btn btn-xs btn-danger-outline', 'data-pjax'=>'')) ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="card-block p-a-0">
					<div class="list-group">
						<?php foreach ($table['fields'] as $key => $field): ?>
							<div class="list-group-item">
								<?php echo $field ?>
								<?php if ($table['index'][$key] == 'primary'): ?>
									<small><span class="label label-sm label-pill label-primary" style="top:-3px">PK</span></small>
								<?php else: ?>
									<button  dmph-del-col class="delete label label-danger pull-right hidden" data-ref="<?php echo $index ?>" data-key="<?php echo $key ?>">delete</button>
								<?php endif ?>
							</div>
						<?php endforeach ?>
					</div>
				</div>
				<div class="card-footer text-muted" style="">
					<small>
						Generate <?php echo $table['rows'] ?> rows
					</small>
				</div>
			</div>
		<?php endforeach ?>
	</div>
<?php endif ?>

<!-- Modal -->
<div class="modal fade" id="create-table" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<?php $url = (isset($url)) ? $url : 'create/tables' ?>
			<?php echo form_open($url, array('class' => 'm-a-0', "pjax-add-tb"=>"")) ?>
				<?php echo form_hidden('database', $database) ?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<i class="glyphicon glyphicon-tasks"></i> <?php echo $database ?> - add a new table
					</div>
					<div class="panel-body">
						<?php if (validation_errors()): ?>
							<div class="alert alert-danger m-a-0">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								<?php echo validation_errors() ?>
							</div>
						<?php endif ?>
						<?php $this->load->view('create/table_fields') ?>
					</div>
					<div class="card-footer">
						<input type="submit" name="new_table" class="btn btn-primary" value="Add Table" data-toggle="modal" data-target=".bd-example-modal-lg">
						
						<?php echo anchor('create', '
							<input type="button" class="btn btn-danger pull-right" value="Cancel">
						') ?>
						<div class="clearfix"></div>
					</div>
				</div>
			<?php echo form_close() ?>
		</div>
	</div>
</div>

<script>
	$(document).ready(function()
	{
		$('button[dmph-del-col]').click(function () {
			var button = $(this);
			var container = button.closest('.list-group-item');
			$.ajax({
				type: 'POST',
				data: {
					ref : button.attr('data-ref'),
					key : button.attr('data-key'),
					"<?php echo $this->security->get_csrf_token_name() ?>" : "<?php echo $this->security->get_csrf_hash() ?>"
				},
				url: "<?php echo base_url(); ?>create/delete/column",
				cache: true,
				beforeSend: function() {
					NProgress.start();
				},
				success: function(data) {
					container.remove();
					$('body').append(data)
				},
				error: function() {},
				complete: function() {
					NProgress.done();
				}
			});
		});
	});
</script>

<?php if ($fields): ?>
	<script>
		$(document).ready(function()
		{
			$('button[data-toggle="modal"]').click();
		});
	</script>
<?php endif; ?>

<?php $this->load->view('includes/footer'); ?>