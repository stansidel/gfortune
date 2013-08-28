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
 * @date   06.07.12
 */
class DateTimeBehavior extends CActiveRecordBehavior {

    public $exception=array();

    public function beforeSave(){
        Yii::trace(get_class($this->getOwner()).'.'.get_class($this).'.beforeSave()','app.components.behaviors');
        foreach($this->getOwner()->metadata->tableSchema->columns as $columnName => $column){

            if (!strlen($this->getOwner()->{$columnName})) continue;

            if (in_array($columnName,$this->exception)) continue;

            if ($column->dbType == 'date'){
                //Yii::trace(get_class($this).'.beforeSave()'."\n".$this->getOwner()->{$columnName},'app.components.behaviors');
                //if ($this->getOwner()->{$columnName}!='0000-00-00') {
                $this->getOwner()->{$columnName} = date('Y-m-d', CDateTimeParser::parse($this->getOwner()->{$columnName}, Yii::app()->locale->dateFormat));
                //}
                //Yii::trace(get_class($this).'.beforeSave()'."\n".$this->getOwner()->{$columnName},'app.components.behaviors');
            }elseif ($column->dbType == 'datetime'){
                //Yii::trace(get_class($this).'.beforeSave()'."\n".$this->getOwner()->{$columnName},'app.components.behaviors');
                //if ($this->getOwner()->{$columnName}!='0000-00-00 00:00:00'){
                $this->getOwner()->{$columnName} = date('Y-m-d H:i:s', CDateTimeParser::parse($this->getOwner()->{$columnName}, Yii::app()->locale->dateFormat.' '.Yii::app()->locale->timeFormat));
                //}
                //Yii::trace(get_class($this).'.beforeSave()'."\n".$this->getOwner()->{$columnName},'app.components.behaviors');
            }
        }
    }


    public function afterFind(){
        Yii::trace(get_class($this->getOwner()).'.'.get_class($this).'.afterFind()','app.components.behaviors');
        foreach($this->getOwner()->metadata->tableSchema->columns as $columnName => $column){

            if (!strlen($this->getOwner()->{$columnName})) continue;

            if (in_array($columnName,$this->exception)) continue;

            if ($column->dbType == 'date'){
                //Yii::trace(get_class($this).'.afterFind()'."\n".$this->getOwner()->{$columnName},'app.components.behaviors');
                //if ($this->getOwner()->{$columnName}!='0000-00-00') {
                $this->getOwner()->{$columnName} = Yii::app()->dateFormatter->formatDateTime(
                    CDateTimeParser::parse($this->getOwner()->{$columnName}, 'yyyy-MM-dd'),'medium',null);
                //}
                //Yii::trace(get_class($this).'.afterFind()'."\n".$this->getOwner()->{$columnName},'app.components.behaviors');
            }elseif ($column->dbType == 'datetime'){
                //Yii::trace(get_class($this).'.afterFind()'."\n".$this->getOwner()->{$columnName},'app.components.behaviors');
                //if ($this->getOwner()->{$columnName}!='0000-00-00 00:00:00'){
                $this->getOwner()->{$columnName} = Yii::app()->dateFormatter->formatDateTime(
                    CDateTimeParser::parse($this->getOwner()->{$columnName}, 'yyyy-MM-dd hh:mm:ss'));
                //}
                //Yii::trace(get_class($this).'.afterFind()'."\n".$this->getOwner()->{$columnName},'app.components.behaviors');
            }
        }
    }

}