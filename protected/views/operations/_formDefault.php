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
 * This file is used for any operation type that doesn't require a special form
 *
 * @author Stanislav Sidelnikov <sidelnikov.stanislav@gmail.com>
 * @date   17.07.12
 */
/* @var $this OperationsController */
/* @var $model Operation */
/* @var $action string */
/* @var $hide boolean */
/* @var $form CActiveForm */
$type = $model->type;
?>
<?php
$debit = $model->getDebitList();
$credit = $model->getCreditList();
/* @var $form CActiveForm */
?>
<?//= $form->errorSummary($model) ?>

<div class="debit">
    <?= $form->labelEx($model, 'debit_category') ?>
    <?= $form->dropDownList($model, 'debit_category', CHtml::listData($debit, 'id', 'name'))?>
    <?= $form->error($model, 'debit_category') ?>
</div>
<div class="credit">
    <?= $form->labelEx($model, 'credit_category') ?>
    <?= $form->dropDownList($model, 'credit_category', CHtml::listData($credit, 'id', 'name')) ?>
    <?= $form->error($model, 'credit_category') ?>
</div>
<div class="sum">
    <?= $form->labelEx($model, 'sum') ?>
    <?= $form->textField($model, 'sum') ?>
    <?php //$this->widget('CMaskedTextField', array('mask' => '9999.99', 'model'=>$model, 'attribute'=>'operationSum')) ?>
    <?= $form->error($model, 'sum') ?>
    <?= $form->hiddenField($model, 'type') ?>
</div>