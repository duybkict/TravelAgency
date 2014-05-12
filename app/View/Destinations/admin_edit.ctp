<div class="col-xs-12 well content">
	<?php if (empty($this->request->data)) : ?>
		<h1>Add new Destination</h1>
	<?php else : ?>
		<h1>Edit Destination</h1>
	<?php endif; ?>

	<?php
	echo $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));
	echo $this->Session->flash();
	
	echo $this->Form->create('Destination');
	echo $this->Form->input('name');
	echo $this->Form->input('image');
	echo $this->Form->input('description', array('type' => 'textarea', 'id' => 'description', 'cols' => 80, 'rows' => 5, 'label' => false, 'div' => false));
	echo '<br />';
	echo $this->Form->radio('published', array('1' => 'Yes', '0' => 'No'), array('legend' => false));
	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->end('Save');
	?>

</div>