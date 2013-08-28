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
 *
 * @property integer $user
 */
class UseredModel extends CActiveRecord
{
    protected function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }
        if (empty($this->user)) {
            $this->user = Yii::app()->user->id;
        }
        return true;
    }

    public final function defaultScope()
    {
        $child = $this->childDefaultScope();
        $userId = Yii::app()->user->id;
        $condition = "user='$userId'";
        if (array_key_exists('condition', $child) && strlen($child['condition']) != 0) {
            $child['condition'] .= " AND $condition ";
        } else {
            $child['condition'] = $condition;
        }
        return $child;
    }

    public function childDefaultScope()
    {
        return array();
    }
}