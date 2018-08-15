<?php $this->load->view('includes/header', array('title' => 'Create Database')) ?>

<div class="lead page-header">create database</div>

<?php if (validation_errors()): ?>
	<div class="alert alert-danger m-t">
		<?php echo validation_errors(); ?>
	</div>
<?php endif ?>

<?php echo form_open('create', array('class' => 'form-inline')) ?>
	<label for="database">New database</label>
	<input type="text" name="new_database" class="form-control">
	<input type="submit" class="btn btn-primary" value="Create">
<?php echo form_close() ?>

<?php $this->load->view('includes/footer') ?>