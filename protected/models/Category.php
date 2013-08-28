<?php

/**
 * This is the model class for table "{{categories}}".
 *
 * The followings are the available columns in table '{{categories}}':
 *
 * @property integer      $id
 * @property integer      $type
 * @property integer      $user
 * @property string       $name
 * @property string       $starting_balance
 * @property string       $date_opened
 *
 * The followings are the available model relations:
 * @property User         $user0
 * @property Operation[]  $operations
 * @property Operation[]  $operations1
 */
class Category extends TypedModel
{
    /**
     * Returns the static model of the specified AR class.
     *
     * @param string $className active record class name.
     *
     * @return Category the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    protected function getBaseClassName()
    {
        return 'Category';
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{categories}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
//			array('user', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=> 255),
            array('starting_balance', 'length', 'max'=> 10),
            array('date_opened, type', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name, starting_balance, date_opened', 'safe', 'on'=> 'search'),
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
            'user0'       => array(self::BELONGS_TO, 'Users', 'user'),
            'operations'  => array(self::HAS_MANY, 'Operations', 'credit_category'),
            'operations1' => array(self::HAS_MANY, 'Operations', 'debit_category'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'               => 'ID',
            'type'             => 'Type',
            'user'             => 'User',
            'name'             => 'Name',
            'starting_balance' => 'Starting Balance',
            'date_opened'      => 'Date Opened',
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
        //$criteria->compare('type',$this->type);
//		$criteria->compare('user',$this->user);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('starting_balance', $this->starting_balance, true);
        $criteria->compare('date_opened', $this->date_opened, true);

        return new CActiveDataProvider($this, array(
                                                   'criteria'=> $criteria,
                                              ));
    }
}