<?php
/**
 * @var array $incomeList
 * @var array $expenseList
 */
$this->breadcrumbs = array(
    'Categories',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<div>
    <?php
    $incomeCategoryUrl = Yii::app()->createAbsoluteUrl("incomeCategory/delete");
    $expenseCategoryUrl = Yii::app()->createAbsoluteUrl("expenseCategory/delete");
    Yii::app()->clientScript->registerScript(
        'category_manipulations',
        "$('body').on(
            'click',
            '.cat_del',
            function(event) {
                var id = $(this).data('id'),
                    type = $(this).data('type'),
                    li = $(this).closest('li');
                var url = '';
                switch(type) {
                    case 'income' :
                        url = '$incomeCategoryUrl';
                        break;
                    case 'expense' :
                        url = '$expenseCategoryUrl';
                        break;
                    default:
                        return;
                }
                $.ajax({
                    type: 'POST',
                    url: url + '/' + id,
                    success:
                        function() {
                            console.log(li);
                            li.fadeOut(100);
                        }
                });
            }
        );"
    );
    ?>

    <h2>Income Categories</h2>
    <?php $this->widget('application.components.CategoryCreateWidget', array('prefix' => 'income')) ?>
    <ul id="income-categories-list">
        <?php foreach ($incomeList as $category) : ?>
        <?php /** @var IncomeCategory $category */ ?>
        <?php Yii::app()->mustache->render('category_line', array('category' => $category)) ?>
        <?php endforeach; ?>
    </ul>
    <h2>Expense Categories</h2>
    <?php $this->widget('application.components.CategoryCreateWidget', array('prefix' => 'expense')) ?>
    <ul id="expense-categories-list">
        <?php foreach ($expenseList as $category) : ?>
        <?php /** @var ExpenseCategory $category */ ?>
        <?php Yii::app()->mustache->render('category_line', array('category' => $category)) ?>
        <?php endforeach; ?>
    </ul>
</div>
