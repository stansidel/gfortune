<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css"
          media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css"
          media="print"/>
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css"
          media="screen, projection"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/gfortune.css"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/less/bootstrap-dev/bootstrap.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php
    Yii::app()->clientScript->registerScriptFile('/js/bootstrap.js',CClientScript::POS_END);
    Yii::app()->clientScript->registerScript(
        'js-nojs',
        "
        document.documentElement.className += ' js';
        var transTexts = [];
        ",
        CClientScript::POS_BEGIN
    );
    ?>
</head>

<body>

<div class="container" id="page">

    <div id="header">
        <div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
    </div>
    <!-- header -->

    <div id="mainmenu">
        <?php $this->widget(
        'zii.widgets.CMenu', array(
                                  'items'=> array(
                                      array('label'=> Yii::t('menu', 'Home'), 'url'=> array('/site/index')),
//				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
//				array('label'=>'Contact', 'url'=>array('/site/contact')),
//                array('label'=>Yii::t('menu', 'Income categories'), 'url'=>array('/incomeCategory/index'), 'visible'=>!Yii::app()->user->isGuest),
//                array('label'=>Yii::t('menu', 'Expense categories'), 'url'=>array('/expenseCategory/index'), 'visible'=>!Yii::app()->user->isGuest),
                                      array('label'  => Yii::t('menu', 'Operations'),
                                            'url'    => array('/operations/index'),
                                            'visible'=> !Yii::app()->user->isGuest),
                                      array('label'  => Yii::t('menu', 'Categories'),
                                            'url'    => array('/categories/index'),
                                            'visible'=> !Yii::app()->user->isGuest),
                                      array('label'  => Yii::t('menu', 'Accounts'),
                                            'url'    => array('/accountCategory/index'),
                                            'visible'=> !Yii::app()->user->isGuest),
                                      array('label'  => 'Login', 'url'=> array('/site/login'),
                                            'visible'=> Yii::app()->user->isGuest),
                                      array('label'=> 'Logout (' . Yii::app()->user->name . ')',
                                            'url'  => array('/site/logout'), 'visible'=> !Yii::app()->user->isGuest),
                                      array('url'    => Yii::app()->getModule('user')->registrationUrl,
                                            'label'  => Yii::app()->getModule('user')->t("Register"),
                                            'visible'=> Yii::app()->user->isGuest),
                                      array('url'    => Yii::app()->getModule('user')->profileUrl,
                                            'label'  => Yii::app()->getModule('user')->t("Profile"),
                                            'visible'=> !Yii::app()->user->isGuest),
                                  ),
                             )
    ); ?>
    </div>
    <!-- mainmenu -->
    <?php if (isset($this->breadcrumbs)): ?>
        <?php $this->widget(
        'zii.widgets.CBreadcrumbs', array(
                                         'links'=> $this->breadcrumbs,
                                    )
    ); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php echo $content; ?>

    <div class="clear"></div>

    <div id="footer">
        Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
        All Rights Reserved.<br/>
        <?php echo Yii::powered(); ?>
    </div>
    <!-- footer -->

</div>
<!-- page -->

</body>
</html>
