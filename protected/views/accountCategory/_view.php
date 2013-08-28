<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('starting_balance')); ?>:</b>
	<?php echo CHtml::encode($data->starting_balance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date_opened')); ?>:</b>
	<?php echo CHtml::encode($data->date_opened); ?>
	<br />

    <?php echo CHtml::link(Yii::t('categories', 'View'), array('view', 'id'=>$data->id)); ?>


</div>