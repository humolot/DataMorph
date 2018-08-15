<?php $this->load->view('includes/header', array('title' => $title)) ?>

<div id="pjax-body">
	<div class="breadcrumb m-t">
		<li class="text-muted">
			<a href="<?php echo base_url("database/view?db=".$database) ?>" data-pjax>
				<i class="fa fa-database m-r"></i><?php echo $database ?>
			</a>
		</li>
		<li class="text-muted">
			<i class="fa fa-table m-r"></i><?=$table?>
		</li>
	</div>
	
	<div class="card">
		<div class="alert alert-info m-a-0" role="alert">
			<i class="fa fa-info-circle m-r-sm"></i>search results for <strong>"<?= $query ?>"</strong>
		</div>

		<div class="card-block p-a-0">
			<?php if (is_object($data)): ?>
				<div class="table-responsive">
					<table class="table table-striped table-bordered m-a-0">
						<thead class="thead-default">
							<tr>
								<?php foreach ($data->fields as $field): ?>
									<th><?=$field?></th>
								<?php endforeach ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data->rows as $key => $row): ?>
								<tr>
									<?php foreach ($data->fields as $field): ?>
										

										
										<?php if ($match->$key->matchCount > 0): ?>
											<?php if ($match->$key->where === $row->$field): ?>
												<td class="table-warning" title="<?= $row->$field ?>">
											<?php else: ?>
												<td title="<?= $row->$field ?>">
											<?php endif ?>
										<?php else: ?>
											<td title="<?= $row->$field ?>">
										<?php endif ?>
											<?= character_limiter(html_escape($row->$field), 15) ?>
										</td>
									<?php endforeach ?>
								</tr>
							<?php endforeach ?>
						</tbody>
						<thead class="thead-default">
							<tr>
								<?php foreach ($data->fields as $field): ?>
									<th><?=$field?></th>
								<?php endforeach ?>
							</tr>
						</thead>
					</table>			
				</div>
			<?php else: ?>
				<div class="alert alert-warning">
					<h5><i class="fa fa-exclamation-circle m-r"></i>No matches were found</h5>
				</div>
			<?php endif ?>
		</div>
	</div>
</div>

<?php $this->load->view('includes/footer') ?>