<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'income-category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'starting_balance'); ?>
		<?php echo $form->textField($model,'starting_balance',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'starting_balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_opened'); ?>
		<?php echo $form->textField($model,'date_opened'); ?>
		<?php echo $form->error($model,'date_opened'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->