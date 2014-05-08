<div class="col-xs-12 well content">
	<h1>Images</h1>
	<hr />

	<?php
	echo $this->Session->flash();
	echo $this->Form->create('Image', array('class' => 'form-inline', 'enctype' => 'multipart/form-data'));
	echo $this->Form->input('image', array('type' => 'file', 'class' => 'btn-default', 'title' => 'Browse a new image', 'onchange' => 'return validateImage();', 'id' => 'image', 'data-filename-placement' => 'inside', 'label' => false, 'div' => false));
	echo '&nbsp;&nbsp;';
	echo $this->Form->submit('Upload', array('class' => 'btn btn-primary', 'onclick' => 'return validateUpload();', 'label' => false, 'div' => false));
	echo $this->Form->end();
	?>

	<div id="links">
		<?php foreach ($images as $image) : ?>
			<div class="thumbnail-wrap">
				<a class="btn btn-default btn-sm btn-preview" href="<?php echo $this->webroot . 'img/' . $image['Image']['image']; ?>" title="" data-gallery>Preview</a>
				<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $image['Image']['id']), array('confirm' => 'Are you sure?', 'class' => 'btn btn-danger btn-sm')); ?>
				<?php echo $this->Html->image($image['Image']['thumbnail'], array('class' => 'img-thumbnail')); ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>

<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery" >
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<script>
	$('input[type=file]').bootstrapFileInput();

	function validateImage() {
		str = $('#image').val().toUpperCase();
		suffixes = new Array('.JPG', 'JPEG', 'PNG', 'GIF');
		suffix2 = ".JPEG";
		flag = false;
		for (i = 0; i < suffixes.length; i++) {
			suffix = suffixes[i];
			if (str.indexOf(suffix, str.length - suffix.length) !== -1) {
				flag = true;
			}
		}

		if (!flag) {
			alert('File type not allowed,\nAllowed file: *.jpg, *.jpeg, *.png, *.gif');
			$('#image').val('');
		}
	}

	function validateUpload() {
		str = $('#image').val().trim();
		if (str == null || str.length <= 0) {
			alert('You have not choose any file to upload');
			return false;
		}

		return true;
	}

</script>