<?php

/**
 * This is the model class for table "{{operations}}".
 *
 * The followings are the available columns in table '{{operations}}':
 *
 * @property integer       $id
 * @property integer       $user
 * @property integer       $type
 * @property string        $datetime
 * @property string        $sum
 * @property integer       $debit_category
 * @property integer       $credit_category
 * @property string        $debit_sum
 * @property string        $credit_sum
 * @property string        $comment
 * @property string        $datetimeText
 *
 * The followings are the available model relations:
 * @property Category      $creditCategory
 * @property Category      $debitCategory
 * @property User          $user0
 */
class Operation extends UseredModel
{
    const TYPE_INCOME = 'income';
    const TYPE_EXPENSE = 'expense';
    const TYPE_TRANSFER = 'transfer';

    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Operation the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    function getDatetimeText()
    {
        return $this->datetime != null ? date('m/d/Y', strtotime($this->datetime)) : null;
    }

    function setDatetimeText($value)
    {
        $this->setDatetime(date('Y-m-d H:i:s', strtotime(str_replace(",", "", $value))));
//        $this->datetime = date('Y-m-d H:i:s', strtotime(str_replace(",", "", $value)));
    }

    function setDatetime($value)
    {
        $nowStr = date('Y-m-d');
        if(strcmp($nowStr, date('Y-m-d', strtotime($value))) === 0)
            $value = date('Y-m-d H:i:s');
        $this->datetime = $value;
    }

    protected function getBaseClassName()
    {
        return 'Operation';
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{operations}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('type, datetime, sum, debit_category, credit_category', 'required'),
            array('debit_category, credit_category', 'numerical', 'integerOnly'=> true),
            array('sum, debit_sum, credit_sum', 'length', 'max'=> 10),
            array('comment, datetimeText, datetime', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, type, datetime, sum, debit_category, credit_category, debit_sum, credit_sum, comment',
                  'safe', 'on'=> 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'creditCategory' => array(self::BELONGS_TO, 'Category', 'credit_category'),
            'debitCategory'  => array(self::BELONGS_TO, 'Category', 'debit_category'),
            'user0'          => array(self::BELONGS_TO, 'Users', 'user'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'              => 'ID',
            'user'            => 'User',
            'type'            => 'Type',
            'datetime'        => 'Datetime',
            'sum'             => 'Sum',
            'debit_category'  => 'Debit Category',
            'credit_category' => 'Credit Category',
            'debit_sum'       => 'Debit Sum',
            'credit_sum'      => 'Credit Sum',
            'comment'         => 'Comment',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
//        $criteria->compare('user', $this->user);
        $criteria->compare('type', $this->type);
        $criteria->compare('datetime', $this->datetime, true);
        $criteria->compare('sum', $this->sum, true);
        $criteria->compare('debit_category', $this->debit_category);
        $criteria->compare('credit_category', $this->credit_category);
        $criteria->compare('debit_sum', $this->debit_sum, true);
        $criteria->compare('credit_sum', $this->credit_sum, true);
        $criteria->compare('comment', $this->comment, true);

        return new CActiveDataProvider($this, array(
                                                   'criteria'=> $criteria,
                                              ));
    }

    /**
     * Returns the list of available categories to be used for debit
     *
     * @return array
     */
    public function getDebitList()
    {
        switch ($this->type) {
            case(self::TYPE_INCOME):
                return AccountCategory::model()->findAll();
            case(self::TYPE_EXPENSE):
                return ExpenseCategory::model()->findAll();
            case(self::TYPE_TRANSFER):
                return AccountCategory::model()->findAll();
            default:
                throw new Exception('Operation type is not set');
        }
    }

    /**
     * Returns the list of available categories to be used for credit
     *
     * @return array
     */
    public function getCreditList()
    {
        switch ($this->type) {
            case(self::TYPE_INCOME):
                return IncomeCategory::model()->findAll();
            case(self::TYPE_EXPENSE):
                return AccountCategory::model()->findAll();
            case(self::TYPE_TRANSFER):
                return AccountCategory::model()->findAll();
            default:
                throw new Exception('Operation type is not set');
        }
    }

    public static function getTypeOptions()
    {
        return array(
            self::TYPE_INCOME   => __('Income', 'operations'),
            self::TYPE_EXPENSE  => __('Expense', 'operations'),
            self::TYPE_TRANSFER => __('Transfer', 'operations'),
        );
    }
}