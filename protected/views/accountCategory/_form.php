<?php
/**
 * @var AccountCategory           $model
 * @var AccountCategoryController $this
 */
?>
<div class="form">

    <?php $form = $this->beginWidget(
    'CActiveForm', array(
                        'id'                  => 'account-category-form',
                        'enableAjaxValidation'=> false,
                   )
);
    /**
     * @var CActiveForm $form
     */
    ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size'=> 60, 'maxlength'=> 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'starting_balance'); ?>
        <?php echo $form->textField($model, 'starting_balance', array('size'=> 10, 'maxlength'=> 10)); ?>
        <?php echo $form->error($model, 'starting_balance'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'date_opened'); ?>
        <?php
        $this->widget(
            'zii.widgets.jui.CJuiDatePicker',
            array(
                 'model' => $model,
                 'attribute' => 'dateOpenedText',
//                 'attribute' => 'date_opened',
//                 'language' => LocaleExtensions::getJQueryLanguageFromYii(),
//'language'=>substr(Yii::app()->getLanguage(), 0, 2),
                 //'name' => 'open_date',
                 // additional javascript options for the date picker plugin
                 'options' => array(
                     'showAnim'=> 'fold',
//                     'dateFormat' => LocaleExtensions::getJQueryDateFormat('short'),
                 ),
                 'htmlOptions'=> array(
                     'style'=> 'height:20px;'
                 ),
            )
        ); ?>
        <?php echo $form->error($model, 'date_opened'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->