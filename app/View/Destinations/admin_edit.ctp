<?php // var_dump($this->request->data); ?>
<div class="col-xs-12 well content">
	<h1>Edit Destination</h1>

	<?php
	echo $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));
	echo $this->Session->flash();
	
	echo $this->Form->create('Destination');
	echo $this->Form->input('name');
	echo $this->Form->input('image');
	echo $this->Form->input('description', array('type' => 'textarea', 'id' => 'content', 'cols' => 80, 'rows' => 5, 'label' => false, 'div' => false));
	echo '<br />';
	echo $this->Form->radio('published', array('1' => 'Yes', '0' => 'No'), array('legend' => false));
	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->end('Save');
	?>

</div>