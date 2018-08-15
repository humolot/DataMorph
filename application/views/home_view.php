<?php $this->load->view('includes/header') ?>

<div class="row">
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="bg-primary panel-body text-center text-muted">
				<h3>WELCOME</h3>
				<h5>TO DATAMORPH</h5>
				<hr>
				<div><small>MANAGER & GENERATOR</small></div>
			</div>
		</div>
	</div>

	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-body text-center bg-inverse">
				<h3>CREATION CENTER</h3>
				With DataMorph, you can quickly create a database prototype with auto-generated
				data that is both random yet relevant.
				<a href="<?php echo base_url("create") ?>">
					<h4>Create Database<i class="glyphicon glyphicon-caret-right"></i></h4>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="breadcrumb">
	Databases found
	<span class="badge"><?php echo count($databases) ?></span>
</div>

<div class="row">
	<?php foreach ($databases as $key => $database): ?>
		<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
			<a class="empty" href="<?php echo base_url('database/'.$database->name) ?>" data-pjax>
				<div class="panel panel-default text-center">
					<div class="panel-body">
						<h1 class="text-muted">
							<i class="glyphicon glyphicon-tasks"></i>
						</h1>
						<?php echo$database->name ?>
					</div>
					<div class="card-footer text-muted">
						<small><?php echo $database->tables ?> tables</small>
					</div>
				</div>
			</a>
		</div>
	<?php endforeach ?>
</div>

<?php $this->load->view('includes/footer') ?>