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
 * along with gFortune.  If not, see <http://www.gnu.org/licenses/agpl.html>.
 */
/**
 * @author Stanislav Sidelnikov <sidelnikov.stanislav@gmail.com>
 * @date   16.07.12
 */
/* @var $model Operation */
/* @var $hide boolean */
$typeName = ucwords($model->type);
$typeId = $model->type;
$action = $model->isNewRecord ? 'create' : 'update';
$viewName = '_form' . $typeName;
$fullPath = __DIR__ . '/' . $viewName . '.php';
if (!is_readable($fullPath)) {
    $viewName = '_formDefault';
}
?>
<div class="form <?php if ($hide) {
    echo 'hide';
} ?>">
    <h1><?php echo $typeName; ?></h1>
    <?php
    $ajaxUrl = CController::createUrl($action);
    $form = $this->beginWidget(
        'CActiveForm', array(
                            'id'                     => "form_$typeId",
                            'action'                 => $action,
                            'enableAjaxValidation'   => true,
                            'enableClientValidation' => true,
                            'clientOptions'          => array(
                                'validateOnSubmit'=> true,
                                'validateOnChange'=> false,
//                                'afterValidate'=>'js:function(form, data, hasError){if(!hasError) {opSubmitSuccess(data, form);}}',
                                'afterValidate'   => "js:function(form, data, hasError){
                                if(!hasError) {
                                    $.ajax({
                                        'type': 'POST',
                                        'url': '$ajaxUrl',
                                        'cache': false,
                                        'data': form.serialize(),
                                        'success': function(data){opSubmitSuccess(data, form);}
                                    })
                                }
                                }",
                            ),
                       )
    );
    ?>
    <div class="datetime">
        <?php $this->widget(
        'zii.widgets.jui.CJuiDatePicker',
        array(
             'model'       => $model,
             'attribute'   => 'datetimeText',
             'flat'        => true,
             'id'          => "db$typeId",
             // additional javascript options for the date picker plugin
             'options'     => array(
                 'showAnim'        => 'fold',
                 'constraintInput' => true,
                 'showButtonPanel' => false,
             ),
             'htmlOptions' => array(
                 'style' => 'height:20px;',
             ),
        )
    );
        ?>
    </div>
    <?php  echo $this->renderPartial(
    $viewName,
    array(
         'model' => $model,
         'form'  => $form,
    )
);
    ?>

    <div class="row buttons">
        <!--        --><?php //echo CHtml::link(
//        __('Create', 'operations'), array($action), array('class' => 'btn formSubmit')
//    ) ?>
        <!--        --><?php //echo CHtml::ajaxSubmitButton(
//        'Create',
//        array($action),
//        array(
//             'success' => 'opSubmitSuccess'
//        ),
//        array('class' => 'btn')) ?>
        <?php echo CHtml::submitButton('Create', array($action), array('class' => 'btn')) ?>
        <?php echo CHtml::link(__('Reset', 'operations'), '#', array('id'=> 'resetFormBtn')) ?>
    </div>
    <?php $this->endWidget(); ?>
</div>