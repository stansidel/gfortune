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
 * @date   17.07.12
 */
/** @var CActiveDataProvider $operationsDataProvider */
?>

<table class="table" id="operations-table">
    <thead>
    <tr>
        <td><?php _e("Type", 'operations') ?></td>
        <td><?php _e("Date", 'operations') ?></td>
        <td><?php _e("Debit", 'operations') ?></td>
        <td><?php _e("Credit", 'operations') ?></td>
        <td><?php _e("Sum", 'operations') ?></td>
        <td><?php _e("Comment", 'operations') ?></td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($operationsDataProvider->getData() as $operation) : ?>
        <?php /** @var Operation $operation */ ?>
    <tr class="operation" id="op<?php echo $operation->id ?>">
        <td><?php echo $operation->type ?></td>
        <td><?php echo date("d.m.Y", strtotime($operation->datetime)) ?></td>
        <td><?php echo $operation->debitCategory->name ?></td>
        <td><?php echo $operation->creditCategory->name ?></td>
        <td><?php echo $operation->sum ?></td>
        <td><?php echo $operation->comment ?></td>
        <td>
            <?= CHtml::link('<i class="icon-pencil"></i>', array('update', 'id' => $operation->id)) ?>
            <?= CHtml::link(
            '<i class="icon-remove"></i>', array('delete', 'id' => $operation->id),
            array('class'=> 'del-item', 'data-id'=> $operation->id)
        ) ?>
        </td>
    </tr>
        <?php endforeach ?>
    </tbody>
    <?php //Yii::app()->mustache->render('operations_tbody', array('operations'=>$operationsDataProvider->getData())) ?>
</table>