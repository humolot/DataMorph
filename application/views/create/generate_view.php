<?php $this->load->view('includes/header', array(
	'title' => 'Create Database',
	'breadcrumb' => array(
		0 => array('name'=>$database, 'link'=>FALSE),
		1 => array('name'=>'Generating', 'link'=>FALSE)
	)
)); ?>

<div class="lead page-header">
	Database "<?php echo $database ?>"
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-refresh spinner" style="margin-right:5px"></span> Generating, please be patient...
	</div>
	<div class="panel-body code-editor" style="background:#000"></div>
</div>

<?php $this->load->view('includes/footer') ?>