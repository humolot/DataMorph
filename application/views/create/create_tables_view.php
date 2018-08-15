<?php $this->load->view('includes/header', array(
	'title' => 'Create Database',
	'breadcrumb' => array(
		0 => array('name'=>$database, 'link'=>FALSE)
	)
)); ?>

<div class="alert alert-warning">
	<span class="glyphicon glyphicon-warning-sign" style="margin-right:10px"></span>
	Database is being saved to memory. Remember to save when you are done
</div>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="row">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?= form_open(current_url(), 'class="navbar-form navbar-left" style="padding-left:0"') ?>
                	<span class="glyphicon glyphicon-tasks text-muted"></span>
                    <div class="form-group input-group">
                        <input type="text" name="name" class="form-control" value="<?php echo $database ?>">
                        <span class="input-group-btn">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="submit" name="rename_database" value="rename" class="btn btn-primary" data-toggle="tooltip" title="rename database">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </button>
                            </div>
                        </span>
                    </div>
                <?= form_close() ?>

                <ul class="nav navbar-nav navbar-right">
                    <li>
						<a href="<?php echo site_url('create/new_table') ?>">
							<span class="text-success">
								<span class="glyphicon glyphicon-plus"></span> Insert Table
							</span>
						</a>
                    </li>
                    <li>
						<a href="<?php echo site_url('create/save') ?>">
							<span class="text-primary">
								<span class="glyphicon glyphicon-floppy-disk"></span> Save
							</span>
						</a>
                    </li>
                    <li>
						<a href="<?php echo site_url('create/cancel') ?>">
							<span class="text-danger">
								<span class="glyphicon glyphicon-remove"></span> Cancel
							</span>
						</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<?php if ($this->session->flashdata('error_msg')): ?>
	<div class="alert alert-danger">
		<?php echo $this->session->flashdata('error_msg') ?>
		<a href class="m-l" data-toggle="modal" data-target="#create-table">Edit Form</a>
	</div>
<?php endif ?>

<div class="lead page-header">
	Tables
</div>

<?php if ( ! $tables): ?>
	<h4 class="lead page-header text-warning" style="border:0">
		This database does not have any tables.
		<a href="<?php echo site_url('create/new_table') ?>" class="alert-link">Add some tables</a>
	</h4>
<?php else: ?>
	<div class="row grid">
		<?php foreach ($tables as $index => $table): ?>
		<div class="grid-item col-md-4 col-lg-3">
			<div class="panel panel-default hoverable">
				<div class="panel-heading">
					<label class="m-a-0"><?php echo $table['name'] ?></label>
					<div class="btn-group pull-right">
						<?php echo anchor('create/edit_table/'.$index, 'edit', 'class="btn btn-xs btn-primary"') ?>
						<?php echo anchor('create/delete_table/'.$index, 'delete', 'class="btn btn-xs btn-danger"') ?>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="list-group">
					<?php foreach ($table['fields'] as $key => $field): ?>
						<div class="list-group-item">
							<?php echo $field['name'] ?>
							<?php if ($field['index'] == 'primary'): ?>
								<small><span class="label label-sm label-pill label-primary" style="top:-3px">PK</span></small>
							<?php else: ?>
								<button  dmph-del-col class="delete label label-danger pull-right hidden" data-ref="<?php echo $index ?>" data-key="<?php echo $key ?>">delete</button>
							<?php endif ?>
							<?php if (isset($field['foreign_key'])): ?>
								<?php if ($field['foreign_key']): ?>
									<small><span class="label label-sm label-pill label-warning" data-toggle="tooltip" title="<?php echo $field['foreign_key'] ?>">FK</span></small>
								<?php endif ?>
							<?php endif ?>
						</div>
					<?php endforeach ?>
				</div>
				<div class="panel-footer text-muted" style="">
					<small>
						Generate <?php echo $table['rows'] ?> rows
					</small>
				</div>
			</div>
		</div>
		<?php endforeach ?>
	</div>
<?php endif ?>

<?php $this->load->view('includes/footer'); ?>