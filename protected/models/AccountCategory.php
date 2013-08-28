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
 * @date   02.07.12
 * @property string dateOpenedText
 */
class AccountCategory extends Category
{
    static function model($className=__CLASS__) {
        return parent::model($className);
    }

//    function defaultScope(){
//        return array(
//            'condition'=>"type='account'",
//        );
//    }
//    public function behaviors()
//    {
////        return array('simpleDateTimeBehavior' => array('class' => 'ext.SimpleDateTimeBehavior'));
//        return array('DateTimeBehavior' => array('class' => 'ext.DateTimeBehavior'));
//    }

    function getDateOpenedText()
    {
        return $this->date_opened != null ? date('m/d/Y', strtotime($this->date_opened)) : null;
    }

    function setDateOpenedText($value)
    {
        $this->date_opened=date('Y-m-d', strtotime(str_replace(",", "", $value)));
    }

//    protected function beforeSave()
//    {
//        if(!parent::beforeSave())
//            return false;
//        $this->date_opened=date('Y-m-d', strtotime(str_replace(",", "", $this->date_opened)));
//        return true;
//    }

//    protected function afterFind()
//    {
//        parent::afterFind();
//        $this->date_opened=date('d F, Y', strtotime(str_replace("-", "", $this->date_opened)));
//    }
    public function rules()
    {
        return array_merge(
            parent::rules(),
            array(
                 array('dateOpenedText', 'safe'),
            )
        );
    }


}