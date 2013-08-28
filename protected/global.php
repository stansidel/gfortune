<?php
/**
 * File with aliases for common functions
 */

/**
 * Alias for {@link Yii::t()}
 *
 * @return string The translation message
 */
function __($message, $category = 'app', $params = array(), $source = null, $language = null)
{
    return Yii::t($category, $message, $params, $source, $language);
}

/**
 * Translate the text using {@link Yii::t()} and echoes it
 */
function _e($message, $category = 'app', $params = array(), $source = null, $language = null)
{
    echo Yii::t($category, $message, $params, $source, $language);
}

?>