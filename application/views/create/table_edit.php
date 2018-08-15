<?php $this->load->view('includes/header', array( 'title' => $title )); ?>

<title><?php echo $title ?></title>

<div id="pjax-body">
	<?php $this->load->view('includes/create/header', array('database' => $database )); ?>

	<?php if (isset($edit_validator)): ?>
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				<span class="sr-only">Close</span>
			</button>
			<i class="fa fa-exclamation-circle m-r-sm"></i> <?php echo $edit_validator->error ?>
		</div>
	<?php endif ?>

	<?php if ($table): ?>
		<?php echo form_open(current_url()) ?>
			<div class="card">
				<div class="card-header">
					<span class="form-inline">
						<i class="fa fa-table m-r-sm"></i>
						<?php echo form_hidden('old_name', $table['name']) ?>
						<input type="text" name="table_name" class="form-control" value="<?php echo $table['name'] ?>">
					</span>
					<?php echo anchor('create/delete_table/'.$ref,
						'Delete Table',
						array('class'=>'btn btn-sm btn-danger pull-right', 'data-pjax' => '')
					) ?>
				</div>
				<div class="card-block p-a-0">
					<div class="table-responsive">
						<table class="table table-striped table-bordered m-a-0">
							<thead class="thead-info">
								<tr>
									<th>Name</th>
									<th>Type</th>
									<th>Length</th>
									<th>Data</th>
									<th>Default</th>
									<th>Null</th>
									<th>A_I</th>
									<th>Index</th>
								</tr>
							</thead>
							<tbody id="dmph-col-wrap">
							<?php (isset($fields) ? true: $fields = count($table['fields'])); ?>
							<?php for ($i=0; $i < $fields; $i++): ?>
									
								<?php if (isset($edit_validator)): ?>
									<?php if (in_array($i, $edit_validator->keys)): ?>
										<tr id="dmph-form-row" class="table-danger">
									<?php endif ?>
								<?php else: ?>
									<tr id="dmph-form-row">
								<?php endif ?>
									<td>
										<?=
										form_input('field_name['.$i.']',
										(isset(set_value('field_name[]')[$i])) ? set_value('field_name[]')[$i] : $table['fields'][$i],
										array("class"=> "form-control"))
										?>
										<?php echo form_error('field_name[]'); ?>
									</td>
									<td>
										<?php $this->load->helper('datamorph') ?>
										<?=
										form_dropdown('field_type[]',
										dmph_type_values(),
										(isset(set_value('field_type[]')[$i])) ? set_value('field_type[]')[$i] : $table['type'][$i],
										array("class"=> "form-control"))
										?>
										<?php echo form_error('field_type[]'); ?>
									</td>
									<td>
										<?php $this->load->helper('datamorph') ?>
										<?=
										form_dropdown('field_data[]',
										dmph_data_values(),
										(isset(set_value('field_data[]')[$i])) ? set_value('field_data[]')[$i] : $table['data'][$i],
										array("class"=> "form-control"))
										?>
										<?php echo form_error('field_type[]'); ?>
									</td>
									<td>
										<?= form_input(array(
									        "name" 		=> 'field_length['.$i.']',
									        "class"		=> "form-control",
									        "type"		=> "number",
									        "value"		=> (isset(set_value('field_length[]')[$i])) ? set_value('field_length[]')[$i] : $table['length'][$i],
									        "maxlength"	=> "220",
									        "style"		=> "width:80px"
										)); ?>
									</td>
									<td>
										<?=
										form_input('field_default['.$i.']',
										(isset(set_value('field_default[]')[$i])) ? set_value('field_default[]')[$i] : $table['default'][$i],
										array("class"=> "form-control"))
										?>
									</td>
									<td>
										<?=
										form_checkbox('field_null['.$i.']',
										"NULL", (isset(set_value('field_null[]')[$i]) OR isset($table['null'][$i])) ? TRUE : FALSE,
										array("class"=> "form-control"))
										?>
									</td>
									<td>
										<?=
										form_checkbox('field_auto['.$i.']',
										"AUTO", (isset(set_value('field_auto[]')[$i]) OR isset($table['auto'][$i])) ? TRUE : FALSE,
										array("class"=> "form-control"))
										?>
									</td>
									<td>
										<?=
										form_dropdown('index['.$i.']',
										array("" => "", "primary" => "PRIMARY", "unique" => "UNIQUE"),
										(isset(set_value('index[]')[$i])) ? set_value('index[]')[$i] :  $table['index'][$i],
										array("class"=> "form-control", "style"=> "min-width:100px"))
										?>
									</td>
								</tr>
							<?php endfor ?>
							</tbody>
						</table>
					</div> <!-- Close table responsive -->
				</div>

				<div class="card-footer">
					<span class="form-inline m-r">
						Rows
						<input type="text" name="rows" class="form-control" value="<?php echo $table['rows'] ?>" style="width:100px">
					</span>
					<input type="submit" name="edit_table" value="Submit" class="btn btn-primary">
				</div>
			</div>
		<?php echo form_close() ?>
	<?php else: ?>
		<div class="alert alert-warning m-a-0">
			<i class="fa fa-warning m-r-sm"></i>The table could not be found.
		</div>
	<?php endif ?>
</div>

<?php $this->load->view('includes/footer'); ?>