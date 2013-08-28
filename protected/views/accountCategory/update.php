<?php
$this->breadcrumbs=array(
	'Account Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AccountCategory', 'url'=>array('index')),
	array('label'=>'Create AccountCategory', 'url'=>array('create')),
	array('label'=>'View AccountCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AccountCategory', 'url'=>array('admin')),
);
?>

<h1>Update AccountCategory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>