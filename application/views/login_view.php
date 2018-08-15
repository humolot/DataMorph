	<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/bootstrap.css" />
	<style type="text/css">
		.contain-sm {
		  width: 100%;
		  margin: 0px auto;
		}
		@media screen and (min-width: 34em) {
		  .contain-sm {
		    width: 353px;
		  }
		}
	</style>
</head>

<body>
	<div class="container-fluid">
        <div class="contain-sm m-t-lg">
			<?php echo form_open('login', array('class'=>'')); ?>
				<div class="text-center">
					<h2 class="lead">DATAMORPH</h2>
				</div>
				<h4 class="text-center text-muted">Connect To Database Server</h4>
				
				<?php if (isset($location)): ?>
					<div class="alert alert-warning">Your session expired.</div>
					<?php echo form_hidden('location', $location) ?>
				<?php endif ?>

					<?php $message = $this->session->flashdata('message'); ?>

					<?php if ($message): ?>
						<div id="notification" class="m-t" style="overflow:hidden">
							<?php if ($message['type'] === "info"): ?>
								<div class="alert alert-info m-a-0">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Close</span>
									</button>
									<i class="fa fa-info-circle m-r-sm"></i> <?php echo $message['content'] ?>
								</div>
							<?php elseif ($message['type'] === "success"): ?>
								<div class="alert alert-success m-a-0">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Close</span>
									</button>
									<i class="fa fa-check-circle m-r-sm"></i> <?php echo $message['content'] ?>
								</div>
							<?php elseif ($message['type'] === "warning"): ?>
								<div class="alert alert-warning m-a-0">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Close</span>
									</button>
									<i class="fa fa-warning m-r-sm"></i> <?php echo $message['content'] ?>
								</div>
							<?php elseif ($message['type'] === "danger"): ?>
								<div class="alert alert-danger m-a-0">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										<span class="sr-only">Close</span>
									</button>
									<i class="fa fa-exclamation-circle m-r-sm"></i> <?php echo $message['content'] ?>
								</div>
							<?php endif ?>
						
							<?php if ($message['type'] === "info" OR $message['type'] === "success"): ?>
							<script>
								setTimeout(function(){
									$('#notification').animate({
										height: 0
									}, 500, function(){
										$('#notification').remove()
									});
								}, <?php echo (isset($message['duration'])) ? $message['duration'] : '3000' ?>)
							</script>
							<?php endif ?>
							
						</div>
					<?php endif ?>

				<div class="panel panel-default">
					<div class="panel-body text-center">
						<div class="progress" style="display:none">
							<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
								connecting...
							</div>
						</div>
						<div class="form-group form-inline">
							<label for="hostname" style="margin-right: 1rem">Hostname</label>
							<input type="text" name="hostname" value="<?php echo set_value('hostname'); ?>" class="form-control" />
							<p class="text-right">
								<?php echo form_error('hostname'); ?>
							</p>
						</div>

						<div class="form-group form-inline">
							<label for="username" style="margin-right: 1rem">Username</label>
							<input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control" />
							<p class="text-right">
								<?php echo form_error('username'); ?>
							</p>
						</div>

						<div class="form-group form-inline">
							<label for="password" style="margin-right: 1rem">Password</label>
							<input type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" />
							<p class="text-right">
								<?php echo form_error('password'); ?>
							</p>
						</div>
						
						<div class="text-center">
							<input name="login" type="submit" value="Connect" class="btn btn-lg btn-block btn-primary" />
						</div>
					</div>
				</div>

				<div class="text-right"><small>&copy <?php echo date('Y') ?> DataMorph</small></div>
			<?php echo form_close(); ?>
		</div>
	</div>

	<script src="<?php echo base_url()?>assets/js/jquery.js"></script>
	<script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {

			$('input[type="submit"]').click(function() {
				$('.progress').show()
			});
		});
	</script>
</body>
</html>