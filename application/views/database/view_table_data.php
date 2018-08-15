<?php $this->load->view('includes/header', array(
	'title' => 'Database '.$database,
	'breadcrumb' => array(
		0 => array('name'=>$database, 'link'=>'database/'.$database),
		1 => array('name'=>$table, 'link'=>FALSE)
	)
)); ?>

<?php if ( ! $data->error): ?>

	<nav class="navbar navbar-default">
	    <div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sub-navbar" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand visible-xs">Table <?php echo $table ?></a>
			</div>

	        <div class="row">
	            <div class="collapse navbar-collapse" id="sub-navbar">
	                <?= form_open(current_url(), 'class="navbar-form navbar-left" style="padding-left:0"') ?>
						<?= form_hidden("database", $database) ?>
						<?= form_hidden("old_name", $table) ?>
						<div class="form-group input-group">
							<div class="input-group-addon"><i class="glyphicon glyphicon-tasks"></i></div>
							<input type="text" class="form-control input-sm" name="new_name" value="<?= set_value('new_name') ? set_value('new_name') : $table ?>" placeholder="new name">
		                    <span class="input-group-btn">
		                        <div class="btn-group" role="group" aria-label="Basic example">
		                            <button type="submit" class="btn btn-sm btn-default"name="table_rename" value="rename" data-toggle="tooltip" data-placement="bottom" title="rename table">
										<span class="text-primary">
											Rename
										</span>
		                            </button>
		                        </div>
		                    </span>
		                </div>
					<?= form_close() ?>
					<?php echo form_error('new_name'); ?>

	                <ul class="nav navbar-nav navbar-right">
	                    <li>
							<a style="cursor:pointer" data-toggle="modal" data-target="#generate-modal" aria-haspopup="true" aria-expanded="false">
								<span class="text-primary">
									<span class="glyphicon glyphicon-plus"></span> Generate Data
								</span>
							</a>
	                    </li>
	                    <li>
							<a href="<?php echo base_url('download/'.$database.'/'.$table) ?>">
								<span class="text-primary">
									<span class="glyphicon glyphicon-download"></span> Download
								</span>
							</a>
	                    </li>
	                    <li>
							<a href="<?php echo base_url('empty/'.$database.'/'.$table) ?>">
								<span class="text-danger">
									<span class="glyphicon glyphicon-unchecked"></span> Empty
								</span>
							</a>
	                    </li>
	                    <li>
							<a href="<?php echo base_url('delete/'.$database.'/'.$table) ?>">
								<span class="text-danger">
									<span class="glyphicon glyphicon-remove"></span> Remove
								</span>
							</a>
	                    </li>
	                </ul>
	            </div>
	        </div>
	    </div>
	</nav>

	<?php echo form_open(current_url()) ?>
		<div class="modal fade" id="generate-modal">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Generate Data for table <code><?php echo $table ?></code></h4>
					</div>
					<?php if ($data->table->insert_fail): ?>
						<div class="modal-body">
							<div class="alert alert-warning">
								<p style="margin-bottom:10px">
									<strong>Foreign key contraint!</strong>
									you must first generate data for referenced table(s)
								</p>

								<ol class="list-group">
									<?php foreach ($data->table->insert_fail as $field): ?>
										<li class="list-group-item">
											<?php echo anchor('database/'.$database.'/'.$field, $field) ?>
										</li>
									<?php endforeach ?>
								</ol>
							</div>
						</div>
					<?php else: ?>
						<div class="modal-body">
							<?php if (validation_errors() AND $this->input->post('generate')): ?>
								<div class="alert alert-danger">Check your entries and try again.</div>
							<?php endif ?>

							<h5 class="lead" style="margin-bottom:10px">Field Data Type</h5>
							<p>Choose the type of data to generate for each field.</p>
							<table class="table table-bordered table-striped table-condensed text-left">
								<?php // Table header with column/field names. ?>
								<thead>
									<tr class="bg-primary">
										<th>Field</th>
										<th>Data</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($data->table->fields as $field): ?>
										<tr>
											<th>
												<?php echo $field['name'] ?>
												<?php if ($field['primary']): ?>
													<small><span class="label label-sm label-pill label-primary" data-toggle="tooltip" title="Primary key">PK</span></small>
												<?php endif ?>
												<?php if ($field['reference']): ?>
													<small><span class="label label-sm label-pill label-warning" data-toggle="tooltip" title="<?php echo $field['reference'] ?>">FK</span></small>
												<?php endif ?>
											</th>
											<td>
												<?php if ($field['reference']): ?>
													<?php echo form_hidden('insert['.$field['name'].'][ref]', $field['reference']) ?>
													<small class="text-muted">
														foreign key references
														<?php $segements = explode('.', $field['reference']) ?>
														table <code><?php echo $segements[0] ?></code> column <code><?php echo $segements[1] ?></code>
														<br>
														This reference table will be used to generate data for this column.
													</small>
												<?php else: ?>
													<?php echo form_dropdown('insert['.$field['name'].'][data]',
							                        $this->datamorph->data_types(),
							                        (set_value('insert['.$field['name'].'][data]')) ? set_value('insert['.$field['name'].'][data]') : '',
							                        array("class"=> "form-control input-sm", 'style'=>'width:120px'))
							                        ?>
							                        <?php echo form_error('<insert></insert>'); ?>
							                    <?php endif ?>
											</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>

							<h5 class="lead" style="margin-bottom:10px">Rows</h5>
							<p>How many rows do you want generated.</p>
							<div class="form-group <?php echo form_error('rows') ? 'has-error' : '' ?>">
								<input type="number" class="form-control" name="rows" value="<?php echo set_value('rows') ? set_value('rows') : '' ?>">
								<?php echo form_error('rows'); ?>
							</div>
						</div>
						<div class="modal-footer form-inline">
							<input type="submit" name="generate" value="Generate" class="btn btn-lg btn-primary">
							<script>
							// Prevent user from click button more than once.
							$(document).ready(function(){
								$('input[name="generate"]').click(function(){
									var btn = $(this); btn.val('Please Wait...')
									setTimeout(function(){btn.attr('disabled', 'disabled')}, 1000)
								})
							})
							</script>
						</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	<?php echo form_close() ?>

	<?php if (validation_errors() AND $this->input->post('generate')): ?>
		<script>
		$(document).ready(function() {$('#generate-modal').modal('show')})
		</script>
	<?php endif ?>

	<?php if (is_object($data->table)): ?>
		<div class="table-responsive">
			<table class="card table table-striped table-bordered" id="item-table">
				
				<?php // Table header with column/field names. ?>
				<thead>
					<tr class="bg-primary">
						<?php foreach ($data->table->fields as $field): ?>
							<th><?php echo $field['name'] ?></th>
						<?php endforeach ?>
					</tr>
				</thead>

				<?php
				// If table data fills a page (i.e. has pagination), then add a footer with field names
				// This is so the user doesn't have to scroll back up to read a column/field name.
				if ($this->pagination->create_links()): ?>
				<tfoot>
					<tr class="bg-primary">
						<?php foreach ($data->table->fields as $field): ?>
							<th><?php echo $field['name'] ?></th>
						<?php endforeach ?>
					</tr>
				</tfoot>
				<?php endif ?>

				<?php // Body to display table content ?>
				<tbody>
				<?php if ($data->table->rows): ?>
					<?php foreach ($data->table->rows as $row): ?>
						<tr>
							<?php foreach ($data->table->fields as $field): ?>
								<td title="<?= $row->$field['name'] ?>">
									<!-- <?= $row->$field['name'] ?> -->
									<?= character_limiter(html_escape($row->$field['name']), 15) ?>
								</td>
							<?php endforeach ?>
						</tr>
					<?php endforeach ?>
				<?php else: ?>
					<tr>
						<td colspan="<?php echo count($data->table->fields) ?>" class="text-muted">
							This table has no data
						</td>
					</tr>
				<?php endif ?>
				</tbody>
			</table>
		</div>

		<?php
		// CI generated pagination for extra pages.
		echo $this->pagination->create_links()
		?>
	<?php endif ?>
<?php else: ?>
	<div class="alert alert-warning">
		<i class="fa fa-exclamation-circle m-r"></i>This table does not exist.
		<?= anchor("database/add_table?target=".$database, "add a table") ?>
	</div>
<?php endif ?>

<?php $this->load->view('includes/footer') ?>