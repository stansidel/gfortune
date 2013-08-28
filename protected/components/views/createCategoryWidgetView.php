<?php
/*
 * This file is part of gFortune.
 *
 * gFortune is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * gFortune is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with gMoney.  If not, see <http://www.gnu.org/licenses/agpl.html>.
 */
/**
 * @author Stanislav Sidelnikov <sidelnikov.stanislav@gmail.com>
 * @date   10.07.12
 */
$name = strtolower($prefix);
$highName = strtoupper(substr($name, 0, 1)) . substr($name, 1);
$modelName = $highName . "Category";
?>
<div class="form" id="<?php echo $name; ?>-category-create">
    <?php $model = new $modelName(); ?>
    <?php $form=$this->beginWidget('CActiveForm', array(
                                                       'id'=>$name . '-category-form',
                                                       'enableAjaxValidation'=>false,
                                                  )); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'name'); ?>
        <?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'name'); ?>
    </div>

    <div class="row buttons">
        <?php
        Yii::app()->clientScript->registerScriptFile("http://github.com/janl/mustache.js/raw/master/mustache.js");
        $template = Yii::app()->mustache->getTemplateJS("category_line");
        $button = CHtml::ajaxSubmitButton(
            $model->isNewRecord ? 'Create' : 'Save',
            Yii::app()->createUrl($name . 'Category/create'),
            array(
                 'dataType' => 'json',
                 'beforeSend' => '
                         function(request) {
                            $("#' . $name . '-category-create-submit").attr("disabled", true);
                         }',
                 'success' => '
                        function(data){
                            var template = \'' . $template . '\';
                            var arr = { category: data };
                            //$("#' . $name . '-categories-list").append("<li id=\"cat\" + " + data.id + "><div>" + data.name + "</div></li>");
                            $("#' . $name . '-categories-list").append(Mustache.to_html(template, arr));
                            $("#' . $highName . 'Category_name").val("");
                         }',
                 'complete' => 'function(){
                        $("#' . $name . '-category-create-submit").attr("disabled", false);
                     }'
            ),
            array(
                 'id' => '' . $name . '-category-create-submit',
            )
        );
        echo $button;
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->