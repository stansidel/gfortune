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

/**
 * @var Operation            $model
 * @var OperationsController $this
 * @var CActiveDataProvider  $operationsDataProvider
 */

$this->breadcrumbs = array(
    'Operation',
);

//$operationTypes = array(
//    "income"   => Yii::t("operations", "Income"),
//    "expense"  => Yii::t("operations", "Expense"),
//    "transfer" => Yii::t("operations", "Transfer"),
//);
$operationTypes = Operation::getTypeOptions();
$curFilter = Yii::app()->user->getState('operations_filter');

if (empty($model)) {
    $model = new Operation();
    $model->type = "income";
    $model->datetime = date('Y-m-d', time());
}
$originalType = $model->type;
Yii::app()->clientScript->registerCssFile('/css/operations.css');
Yii::app()->clientScript->registerScriptFile('/js/operations.js', CClientScript::POS_END);
?>

<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div class="centerize">
    <!--    <div class="nojs">-->
    <!--        Link to creating an operation without JS-->
    <!--    </div>-->
    <div class="jsonly" id="form">
        <div id="operationTypes">
            <ul>
                <?php foreach ($operationTypes as $type => $label) : ?>
                <li <?php if ($type === $model->type) {
                    echo ' class="active"';
                } ?>>
                    <a class="change-type" href="#" data-form="form_<?php echo $type ?>">
                        <?php echo $label ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="ajax-form">
            <?php
            foreach ($operationTypes as $type=> $name) {
                $model->type = $type;
                $this->renderPartial(
                    '_formOperation',
                    array(
                         'model'=> $model,
                         'hide' => $type != $originalType,
                    )
                );
            };
            ?>
        </div>
    </div>
</div>
<div class="btn-group" data-toggle="buttons-radio" id="period-switch">
    <?php foreach($this->getFilterOptions() as $value=>$name) : ?>
    <button class="btn btn-primary<?php if($value == $curFilter) echo " active"; ?>" data-index="<?php echo $value ?>"><?php echo $name ?></button>
    <?php endforeach; ?>
</div>
<?php //Yii::app()->clientScript->registerScript('buttons', "$('.nav-tabs').button();", CClientScript::POS_READY) ?>
<?php echo $this->renderPartial('_indexTablePartial', array('operationsDataProvider' => $operationsDataProvider)) ?>
