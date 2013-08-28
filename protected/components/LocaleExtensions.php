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
 * @see http://stackoverflow.com/questions/11308353/yii-using-i18n-with-cjuidatepicker
 * @date   09.07.12
 */
class LocaleExtensions {
    private static $yiiTojQueryFormatConversion = array(
        'yyyy' => 'yy',
        'yy' => 'y',
        'MMMM' => 'MM',
        'MMM' => 'M',
        'MM' => 'mm',
        'M' => 'm',
    );

    private static $yiiTojQueryLanguageConversion = array(
        'en' => 'en-GB',
    );

    public static function getJQueryDateFormat($width='medium') {
        return strtr(Yii::app()->getLocale()->getDateFormat($width),
            self::$yiiTojQueryFormatConversion);
    }

    public static function getJQueryLanguageFromYii($language = null) {
        if ($language == null) {
            $language = Yii::app()->getLanguage();
        }

        if (isset(self::$yiiTojQueryLanguageConversion[$language])) {
            return self::$yiiTojQueryLanguageConversion[$language];
        } else {
            $language = str_replace('_', '-', $language);
            $language = substr($language, 0, 3) . strtoupper(substr($language, 3, 2));
        }

        return $language;
    }
}