<?php
$this->breadcrumbs=array(
	'Account Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AccountCategory', 'url'=>array('index')),
	array('label'=>'Manage AccountCategory', 'url'=>array('admin')),
);
?>

<h1>Create AccountCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>