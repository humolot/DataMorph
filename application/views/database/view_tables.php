<?php $this->load->view('includes/header', array(
	'title' => 'Database '.$database,
	'breadcrumb' => array(
		0 => array('name'=>$database, 'link'=>FALSE)
	)
)); ?>

<div class="page-header">
	<div class="form-inline pull-left">
		<?= anchor("insert_table/".$database, '
		<button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="add new table">
			Add New Table
		</button>
		') ?>

		<?php if (isset($tables->number)): ?>
			<?= anchor("download/".$database, '
			<button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="download database '.$database.'">
				Download
			</button>
			') ?>
		<?php else: ?>
			<button class="btn btn-sm btn-default" disabled="disabled">
				Download
			</button>
		<?php endif ?>
	</div>
	<div class="pull-right">
		<a href="<?php echo base_url('delete/'.$database) ?>">
			<button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="delete database <?= $database ?>">
				delete database
			</button>
		</a>
	</div>
	<div class="clearfix"></div>
</div>

<?php if (isset($tables->number)): ?>
	<?php foreach ($tables as $table): ?>
		<?php if (is_object($table)): ?>
			<div class="list-group">
				<div class="list-group-item">
					<a class="empty" href="<?php echo base_url('database/'.$database.'/'.$table->name) ?>" data-pjax>
						<div class="media">
							<div class="media-left">
								<h1 class="text-muted" style="margin:0">
									<i class="glyphicon glyphicon-list-alt"></i>
								</h1>
							</div>
							<div class="media-body">
								<?php echo$table->name ?>
								<p>
									<small><?php echo $table->rows ?> rows</small>
								</p>
							</div>
						</div>
					</a>
				</div>
			</div>
		<?php endif ?>
	<?php endforeach ?>
<?php else: ?>
	<div class="alert alert-info">
		<i class="fa fa-info-circle m-r"></i>No tables were found.
	</div>
<?php endif ?>

<?php $this->load->view('includes/footer') ?>