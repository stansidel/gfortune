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
 *
 * @property integer $type
 * @property integer $user
 */
abstract class TypedModel extends UseredModel
{
    protected function beforeValidate()
    {
        if (!parent::beforeValidate()) {
            return false;
        }
        if (empty($this->type)) {
            $type = strtolower($this->getName());
            $this->type = $type;
        }
        return true;
    }

    public final function childDefaultScope()
    {
        $type = strtolower($this->getName());
        $condition = "";
        if (strlen($type) > 0) {
            $condition = "type='$type' ";
        }
        return array(
            'condition'=> $condition,
        );
    }

    protected function getName()
    {
        $childClass = strtolower(get_called_class());
        $type = substr($childClass, 0, strlen($childClass) - strlen($this->getBaseClassName()));
        return $type;
    }

    protected function instantiate($attributes)
    {
        $class = ucwords(strtolower($attributes['type'])) . $this->getBaseClassName();
        if (!class_exists($class)) {
            $class = $this->getBaseClassName();
        }
        $model = new $class(null);
        return $model;
    }

    protected abstract function getBaseClassName();
}