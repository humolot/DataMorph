<?php $this->load->view('includes/header', array(
    'title' => 'Create Database',
    'breadcrumb' => array(
        0 => array('name'=>$database, 'link'=>'create'),
        1 => array('name'=>'Edit table', 'link'=>FALSE),
        2 => array('name'=>$table['name'], 'link'=>FALSE)
    )
)); ?>

<?php if (validation_errors()): ?>
	<div class="alert alert-danger m-a-0">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			<span class="sr-only">Close</span>
		</button>
        <?php if ($this->input->post('delete_selected')): ?>
            <?php echo validation_errors() ?>
        <?php else: ?>
            The form was submitted with errors. Check the form for and try again.
        <?php endif ?>
	</div>
<?php endif ?>

<?php echo form_open(current_url()) ?>

<div class="row">
    <div class="col-md-6">
        <div class="form-group <?php echo (form_error('table_name')) ? 'has-error' : '' ?>">
            <label for="table_name">Table Name</label>
            <input type="text" class="form-control" name="table_name" value="<?php echo set_value('table_name') ? set_value('table_name') : $table['name'] ?>">
            <p class="help-block"><?php echo form_error('table_name') ? form_error('table_name') : '&nbsp' ?></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group <?php echo (form_error('rows')) ? 'has-error' : '' ?>">
            <label for="rows">Table Rows</label>
            <input type="number" class="form-control" name="rows" value="<?php echo (set_value('rows')) ? set_value('rows') : $table['rows'] ?>">
            <p class="help-block"><?php echo form_error('rows') ? form_error('rows') : 'Rows to be generated when populating the table' ?></p>
        </div>
    </div>
</div>
    
<div class="lead page-header">
    Edit Table Fields
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-form navbar-left">
            <input type="submit" name="delete_selected" value="Delete Selected Fields" class="btn btn-danger">
        </div>
    </div>
</nav>

<div class="table-responsive">
    <table class="table table-striped" style="border-radius:.25rem;overflow:hidden">
        <thead class="thead-inverse">
            <tr>
                <th class="text-center"><?php echo form_checkbox('select_all') ?></th>
                <th>Field Name</th>
                <th>Type</th>
                <th>Length</th>
                <th>
                    <div data-toggle="tooltip" title="Data to generate when populating the table">
                        Data <small><span class="glyphicon glyphicon-info-sign text-info"></span></small>
                    </div>
                </th>
                <th>Default</th>
                <th>Null</th>
                <th>A_I</th>
                <th>Index</th>
                <th>
                    <div data-toggle="tooltip" title="If a field is a foreign key, Choose the table.field that it points to">
                        Foreign Key <small><span class="glyphicon glyphicon-info-sign text-info"></span></small>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody id="dmph-col-wrap">
            <?php foreach($table['fields'] as $i => $field): ?>
            <tr class="dmph-form-row">
                <td class="text-center">
                    <?php echo form_checkbox('selected[]', $i) ?>
                </td>
                <td>
                    <div class="form-group <?php echo form_error('update['.$i.'][name]') ? 'has-error' : '' ?>">
                        <?=
                        form_input('update['.$i.'][name]',
                        (set_value('update['.$i.'][name]')) ? set_value('update['.$i.'][name]') : $field['name'],
                        array("class"=> "form-control"))
                        ?>
                        <?php echo form_error('update['.$i.'][name]'); ?>
                    </div>
                </td>
                <td>
                    <div class="form-group <?php echo form_error('update['.$i.'][type]') ? 'has-error' : '' ?>">
                        <?=
                        form_dropdown('update['.$i.'][type]',
                        $this->datamorph->field_types(),
                        (set_value('update['.$i.'][type]')) ? set_value('update['.$i.'][type]') : $field['type'],
                        array("class"=> "form-control", 'style'=>'width:120px'))
                        ?>
                        <?php echo form_error('update['.$i.'][type]'); ?>
                    </div>
                </td>
                <td>
                    <div class="form-group <?php echo form_error('update['.$i.'][length]') ? 'has-error' : '' ?>">
                        <?= form_input(array(
                            "name"      => 'update['.$i.'][length]',
                            "class"     => "form-control",
                            "type"      => "number",
                            "value"     => (set_value('update['.$i.'][length]')) ? set_value('update['.$i.'][length]') : $field['length'],
                            "maxlength" => "220",
                            "style"     => "width:80px"
                        )); ?>
                        <?php echo form_error('update['.$i.'][length]') ?>
                    </div>
                </td>
                <td>
                    <div class="form-group <?php echo form_error('update['.$i.'][data]') ? 'has-error' : '' ?>">
                        <?=
                        form_dropdown('update['.$i.'][data]',
                        $this->datamorph->data_types(),
                        (set_value('update['.$i.'][data]')) ? set_value('update['.$i.'][data]') : $field['data'],
                        array("class"=> "form-control", 'style'=>'width:120px'))
                        ?>
                        <?php echo form_error('update['.$i.'][data]'); ?>
                    </div>
                </td>
                <td>
                    <div class="form-group <?php echo form_error('update['.$i.'][default]') ? 'has-error' : '' ?>">
                        <?=
                        form_input('update['.$i.'][default]',
                        (set_value('update['.$i.'][default]')) ? set_value('update['.$i.'][default]') : $field['default'],
                        array("class"=> "form-control"))
                        ?>
                        <?php echo form_error('update['.$i.'][default]') ?>
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group <?php echo form_error('update['.$i.'][null]') ? 'has-error' : '' ?>">
                        <?=
                        form_checkbox('update['.$i.'][null]',
                        "NULL", (set_value('update['.$i.'][null]') OR isset($field['null'])) ? TRUE : FALSE)
                        ?>
                        <?php echo form_error('update['.$i.'][null]') ?>
                    </div>
                </td>
                <td class="text-center">
                    <div class="form-group <?php echo form_error('update['.$i.'][auto]') ? 'has-error' : '' ?>">
                        <?=
                        form_checkbox('update['.$i.'][auto]',
                        "AUTO", (set_value('update['.$i.'][auto]') OR isset($field['auto'])) ? TRUE : FALSE)
                        ?>
                        <?php echo form_error('update['.$i.'][auto]') ?>
                    </div>
                </td>
                <td>
                    <div class="form-group <?php echo form_error('update['.$i.'][index]') ? 'has-error' : '' ?>">
                        <?=
                        form_dropdown('update['.$i.'][index]',
                        array("" => "", "primary" => "PRIMARY", "unique" => "UNIQUE"),
                        (set_value('update['.$i.'][index]')) ? set_value('update['.$i.'][index]') : $field['index'],
                        array("class"=> "form-control", "style"=> "min-width:100px"))
                        ?>
                        <?php echo form_error('update['.$i.'][index]') ?>
                    </div>
                </td>
                <td>
                    <div class="form-group <?php echo form_error('update['.$i.'][foreign_key]') ? 'has-error' : '' ?>">
                        <?=
                        form_dropdown('update['.$i.'][foreign_key]',
                        $foreign_keys,
                        (set_value('update['.$i.'][foreign_key]')) ? set_value('update['.$i.'][foreign_key]') : (isset($field['foreign_key']) ? $field['foreign_key'] : ''),
                        array("class"=> "form-control input-sm", "style"=> "min-width:100px"))
                        ?>
                        <label for="on_update" style="margin:0">On update</label>
                        <?=
                        form_dropdown('update['.$i.'][on_update]',
                        array('NO ACTION'=>'NO ACTION','CASCADE'=>'CASCADE'),
                        set_value('update['.$i.'][on_update]') ? set_value('update['.$i.'][on_update]') : isset($field['on_update']) ? $field['on_update'] : '',
                        array("class"=> "form-control input-sm", "style"=> "min-width:100px"))
                        ?>
                        <label for="on_delete" style="margin:0">On delete</label>
                        <?=
                        form_dropdown('update['.$i.'][on_delete]',
                        array('NO ACTION'=>'NO ACTION','CASCADE'=>'CASCADE'),
                        set_value('update['.$i.'][on_delete]') ? set_value('update['.$i.'][on_delete]') : isset($field['on_delete']) ? $field['on_delete'] : '',
                        array("class"=> "form-control input-sm", "style"=> "min-width:100px"))
                        ?>
                        <?php echo form_error('update['.$i.'][foreign_key]') ?>
                    </div>
                </td>
            </tr>
            <?php endforeach ?>
            <tr>
                <td colspan="10" class="text-right">
                    <button type="button" class="btn btn-default" id="dmph-add-col">
                        <small>ADD ROW</small>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div> <!-- Close table responsive -->

<hr>

<input type="submit" name="edit_table" class="btn btn-lg btn-success" value="Update Table">

<?php echo form_close() ?>

<script>
	window.onload = function () {
		$('#dmph-add-col').click(function(){
			// Get last element to be cloned and increment the index id.
            var last_el = $('table tr.dmph-form-row').last();

            // To set a new unique field name for the 'to-be-cloned' row, we need to obtain the current highest index id from the existing field names.
            var input_name = last_el.find('input, select, textarea').first().attr('name');
            // Dont clear radios
            // var input_name = last_el.find('input, select, textarea').not('input:radio').first().attr('name');
            input_name = input_name.substring(input_name.indexOf(']')+1);
            
            var highest_id = last_el.index();
            
            // Loop through all field names and check if the index id is higher than the currently set highest.
            $('input[name$="'+input_name+'"], select[name$="'+input_name+'"], textarea[name$="'+input_name+'"]').each(function()
            {
                var row_name = $(this).attr('name');
                if (parseInt(row_name.substring(row_name.indexOf('[')+1, row_name.indexOf(']'))) > highest_id)
                {
                    highest_id = parseInt(row_name.substring(row_name.indexOf('[')+1, row_name.indexOf(']')));
                }           
            });

            // Get last element to be cloned and increment the index id.
            var last_el = $('table tr.dmph-form-row').last();
            var new_id = highest_id+1;

            // Clone target row.
            var new_row = last_el.clone().insertAfter(last_el);

            // Set names for new elements by incrementing the current elements index (Example: name="insert[0][xxx]" updates to name="insert[1][xxx]").
            // Note: This example requires the first square bracket value must be the index value. Change the code below if your naming convention differs.
            new_row.find('input, select, textarea').not('input:radio').each(function()
            {
                $(this).val('');
                $(this).attr('checked', false);
                if (typeof($(this).attr('name')) != 'undefined')
                {
                    var cloned_name = $(this).attr('name');
                    var new_name = cloned_name.substring(0, cloned_name.indexOf('[')+1) + new_id + cloned_name.substring(cloned_name.indexOf(']'));         
                    $(this).attr('name', new_name);
                }
            });
		});
	};
</script>

<?php $this->load->view('includes/footer'); ?>