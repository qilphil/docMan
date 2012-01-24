<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>



<p>You may change the content of this page by modifying the following two files:</p>
<ul>
	<li><a href="<?php echo $this->createUrl('user/index')?>">Users</a></li>
	<li><a href="<?php echo $this->createUrl('file/index')?>">Files</a></li>
	<li><a href="<?php echo $this->createUrl('file/upload')?>">File Upload</a></li>
	<li><a href="<?php echo $this->createUrl('tags/index')?>">Tags</a></li>
	
</ul>
