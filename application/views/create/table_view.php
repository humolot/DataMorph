<?php if ( ! $tables): ?>
	<div class="alert alert-warning">
		This database does not have any tables.
		<a href="<?php echo site_url('create/new_table') ?>" class="alert-link">Add some tables</a>
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
				<?php echo form_hidden('database', $infobase) ?>
				<div class="card m-a-0">
					<div class="card-header">
						<?php if (validation_errors()): ?>
							<div class="alert alert-danger m-a-0">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								<?php echo validation_errors() ?>
							</div>
						<?php endif ?>
						<?php if ($validate): ?>
							<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								<?php echo $validate->error ?>
							</div>
						<?php endif ?>
						<h5 class="m-t m-b-md" ng-if="database">
							<i class="fa fa-database m-r-sm"></i><?= $infobase ?> <span class="text-muted">- add a new table</span>
						</h5>
					</div>
					<div class="card-block">
							<?php $this->load->view('create/table_fields') ?>
						</div>
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

<?php $this->load->view('includes/footer') ?>