<?php // var_dump($destinations);    ?>
<div class="col-xs-12 well content">
	<h1>Destinations</h1>

	<table class="table table-striped">
		<thead>
			<tr>
				<td>ID</td>
				<td>Image</td>
				<td>Name</td>				
				<td>Description</td>
				<td>Published</td>
				<td>Published Date</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($destinations as $d) : ?>
				<tr>
					<td><?php echo $d['Destination']['id']; ?></td>
					<td><?php echo $this->Html->image($d['Destination']['image']); ?></td>
					<td><?php echo $d['Destination']['name']; ?></td>					
					<td width="40%"><?php echo $d['Destination']['description']; ?></td>
					<td width="1%" class="text-center">
						<?php
						echo ($d['Destination']['published'] == 1) ? '<span class="glyphicon glyphicon-ok text-success"></span>' : '<span class="glyphicon glyphicon-remove text-danger"></span>';
						?>
					</td>
					<td><?php echo $d['Destination']['published_date']; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>

	<ul class="pagination pull-right">
		<?php
		echo '<li class="counter disabled"><a>' . $this->Paginator->counter('Showing vacations {:start} - {:end} out of {:count} total') . '</a></li>';
		
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