<div class="col-xs-12 well content">
	<h1>Users Management</h1>

	<?php echo $this->Session->flash(); ?>

	<table class="table table-striped">
		<thead>
			<tr>
				<td>ID</td>
				<td>Email</td>
				<td>Role</td>				
				<td>Modified Date</td>
				<td>Created Date</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $u) : ?>
				<tr>
					<td><?php echo $u['User']['id']; ?></td>
					<td><?php echo $u['User']['email']; ?></td>
					<td><?php echo $u['User']['role']; ?></td>					
					<td><?php echo $u['User']['modified']; ?></td>
					<td><?php echo $u['User']['created']; ?></td>
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