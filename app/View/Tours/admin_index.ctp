<?php // var_dump($destinations);      ?>
<div class="col-xs-12 well content">
	<h1>Tours Management</h1>

	<table class="table table-striped">
		<thead>
			<tr>
				<td>ID</td>
				<td>Thumbnail</td>
				<td>Name</td>				
				<td>Short Desc</td>
				<td>Price</td>
				<td>Destination</td>
				<td>Published</td>
				<td>Published Date</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tours as $t) : ?>
				<tr>
					<td><?php echo $t['Tour']['id']; ?></td>
					<td><?php echo $this->Html->image($t['Tour']['thumbnail']); ?></td>
					<td>
						<strong><?php echo $t['Tour']['name']; ?></strong><br />
						<?php echo $t['Tour']['details']; ?>
					</td>					
					<td width="25%"><?php echo $t['Tour']['short_description']; ?></td>
					<td width="1%">&dollar;<?php echo $t['Tour']['price']; ?></td>
					<td>&dollar;<?php echo $t['Destination']['name']; ?></td>
					<td width="1%" class="text-center">
						<?php
						echo ($t['Tour']['published'] == 1) ? '<span class="glyphicon glyphicon-ok text-success"></span>' : '<span class="glyphicon glyphicon-remove text-danger"></span>';
						?>
					</td>
					<td><?php echo $t['Tour']['published_date']; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>

	<ul class="pagination pull-right">
		<?php
		echo '<li class="counter disabled"><a>' . $this->Paginator->counter('Showing records {:start} - {:end} out of {:count} total') . '</a></li>';

		echo $this->Paginator->first(
			'<< First', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'span', 'class' => 'disabled')
		);

		echo $this->Paginator->prev(
			'<', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'span', 'class' => 'disabled')
		);

		echo $this->Paginator->numbers(array(
			'tag' => 'li',
			'separator' => '',
			'currentTag' => 'a',
			'currentClass' => 'active',
		));

		echo $this->Paginator->next(
			'>', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'span', 'class' => 'disabled')
		);

		echo $this->Paginator->last(
			'Last >>', array('tag' => 'li'), null, array('tag' => 'li', 'disabledTag' => 'span', 'class' => 'disabled')
		);
		?>
	</ul>
</div>