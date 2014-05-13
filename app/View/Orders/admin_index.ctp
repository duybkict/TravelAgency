<?php $statuses = array('Pending', 'Confirmed', 'Canceled'); ?>

<div class="col-xs-12 well content">
	<h1>Orders Management</h1>

	<?php echo $this->Session->flash(); ?>

	<table class="table table-striped">
		<thead>
			<tr>
				<td>ID</td>
				<td>Email</td>
				<td>Status</td>				
				<td>Modified Date</td>
				<td>Created Date</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($orders as $o) : ?>
				<tr>
					<td><?php echo $o['Order']['id']; ?></td>
					<td><?php echo $o['Order']['email']; ?></td>
					<td><?php echo $statuses[$o['Order']['status']]; ?></td>					
					<td><?php echo $o['Order']['modified']; ?></td>
					<td><?php echo $o['Order']['created']; ?></td>
					<td width="125px;">
						<?php
						echo $this->Html->link(
							'Edit', array('action' => 'edit', $o['Order']['id']), array('class' => 'btn btn-primary btn-sm')
						);
						echo ' ';
						echo $this->Form->postLink(
							'Delete', array('action' => 'delete', $o['Order']['id']), array('class' => 'btn btn-danger btn-sm'), 'Are you sure?'
						);
						?>
					</td>
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