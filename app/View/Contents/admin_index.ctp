<div class="col-xs-12 well content">
	<h1>Edit Content</h1>
	<?php
	echo $this->Session->flash();
	echo $this->Form->create('Content', array('class' => 'form-inline'));	
	echo $this->Form->input('id');
	echo $this->Form->input('content', array('type' => 'textarea', 'id' => 'content', 'cols' => 80, 'rows' => 5, 'label' => false, 'div' => false));
	echo $this->TinyMCE->editor(array('theme' => 'advanced', 'mode' => 'textareas'));
	echo '<br />';
	echo $this->Form->submit('Update', array('class' => 'btn btn-primary'));
	echo $this->Form->end();
	?>
</div>