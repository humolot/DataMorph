<!DOCTYPE html>
<html lang="en">
<head>
	<title>Frisk</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css') ?>" />
	
	<script src="<?php echo base_url('assets/js/jquery.js')?>"></script>
	<style>
		.spinner {
			-webkit-animation: rotate 2.0s infinite linear;
			   -moz-animation: rotate 2.0s infinite linear;
			    -ms-animation: rotate 2.0s infinite linear;
			     -o-animation: rotate 2.0s infinite linear;
					animation: rotate 2.0s infinite linear;
		}
		@-webkit-keyframes rotate { 100% { -webkit-transform: rotate(360deg) }}
		   @-moz-keyframes rotate { 100% { -webkit-transform: rotate(360deg) }}
			@-ms-keyframes rotate { 100% { -webkit-transform: rotate(360deg) }}
			 @-o-keyframes rotate { 100% { -webkit-transform: rotate(360deg) }}
				@keyframes rotate { 100% { -webkit-transform: rotate(360deg) }}
		@keyframes rotate { 
			100% {
				-webkit-transform: rotate(360deg);
				   -moz-transform: rotate(360deg);
					-ms-transform: rotate(360deg);
					 -o-transform: rotate(360deg);
						transform: rotate(360deg);
			}
		}
	</style>
</head>

<?php
$info = $this->datamorph->info();
// Links to show active pages
if (!isset($link)) $link = NULL;
if (!isset($sub_link)) $sub_link = NULL;
?>

<body style="margin:0">
	<nav class="navbar navbar-inverse" style="border-radius:0">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-collapse" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo site_url() ?>" >
					DATAMORPH
				</a>
			</div>

			<div class="collapse navbar-collapse" id="top-navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="dropdown <?php echo ($link == 'database') ? 'active' : '' ?>">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<i class="glyphicon glyphicon-database"></i> Databases <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<?php foreach ($this->datamorph->databases() as $key => $database): ?>
								<li class="<?php echo ($link == 'database' AND $sub_link == $database) ? 'active' : '' ?>">
									<?php echo anchor('database/'.$database, $database) ?>
								</li>
							<?php endforeach ?>
						</ul>
					</li>
					<li>
						<?php echo anchor('create', 'Create Database') ?>
					</li>
				</ul>
				<?php echo form_open(site_url('logout'), 'class="form-inline navbar-form navbar-right"') ?>
					<a href="<?php echo site_url('logout') ?>" class="btn btn-danger">logout</a>
				</form>
			</div>
		</div>
	</nav>

	<div class="container">

	<?php // Breadcrumbs for pages ?>
	<?php if (!isset($breadcrumb)) $breadcrumb = array(); ?>
	<?php if ($breadcrumb): ?>
	    <ol class="breadcrumb">
            <li><?php echo anchor(site_url(), $info->server) ?></li>
	        <?php foreach ($breadcrumb as $nav): ?>
	            <li class="<?php echo ($nav['link']) ? '' : 'active' ?>">
	                <?php echo ($nav['link']) ? anchor($nav['link'], $nav['name']) : $nav['name'] ?>
	            </li>
	        <?php endforeach ?>
	    </ol>
	<?php endif ?>
	<?php // End of breadcrumbs ?>

	<?php // Alert users to changes and notifications ?>
	<?php $alert = $this->session->flashdata('alert'); ?>
    <?php if (isset($alert['type'])): ?>
        <?php
        if ($alert['type'] === 'success')
            $icon = '<span class="glyphicon glyphicon-ok-sign" style="margin-right:10px"></span>';
        else if($alert['type'] === "warning")
            $icon = '<span class="glyphicon glyphicon-warning-sign" style="margin-right:10px"></span>';
        else if($alert['type'] === "danger")
            $icon = '<span class="glyphicon glyphicon-exclamation-sign" style="margin-right:10px"></span>';
        else
            $icon = '<span class="glyphicon glyphicon-info-sign" style="margin-right:10px"></span>';
        ?>

        <div class="alert alert-<?= $alert['type'] ?> alert-fixed-top">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <?= $icon.$alert['message'] ?>
        </div>

        <?php if ($alert['type'] === 'success' || $alert['type'] === 'info' || $alert['type'] === 'warning'): ?>
            <script type="text/javascript">
                setTimeout(function(){
                    $('.alert-fixed-top').addClass('fadeOutUp');
                }, 5000)
                setTimeout(function(){
                    $('.alert-fixed-top').remove();
                }, 5500)
            </script>
        <?php endif ?>
    <?php endif ?>
	<?php // End of alerts ?>