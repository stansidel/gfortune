<?php

class m120625_144500_first extends CDbMigration
{
    public function up()
    {
        if($this->dbConnection->tablePrefix == null){
            echo "The table prefix in protected/config/console.php is not set.";
            return false;
        }
        $standardOption = "ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
//        $this->createTable(
//            '{{category_types}}',
//            array(
//                 'id'=>'pk',
//                 'name'=>'string NOT NULL'
//            ),
//            $standardOption
//        );
//        $this->insert('{{category_types}}', array('name'=>'Account'));
//        $this->insert('{{category_types}}', array('name'=>'Income'));
//        $this->insert('{{category_types}}', array('name'=>'Expense'));
//        $this->createTable(
//            '{{operation_types}}',
//            array(
//                 'id'=>'pk',
//                 'name'=>'string NOT NULL',
//                 'debit_category'=>'integer NOT NULL',
//                 'credit_category'=>'integer NOT NULL'
//            ),
//            $standardOption
//        );
//        $this->addForeignKey(
//            'fk_operation_types_debit_category',
//            '{{operation_types}}',
//            'debit_category',
//            '{{category_types}}',
//            'id',
//            'RESTRICT',
//            'RESTRICT'
//        );
//        $this->addForeignKey(
//            'fk_operation_types_credit_category',
//            '{{operation_types}}',
//            'credit_category',
//            '{{category_types}}',
//            'id',
//            'RESTRICT',
//            'RESTRICT'
//        );
//        $this->insert(
//            '{{operation_types}}',
//            array(
//                 'name' => 'Income',
//                 'debit_category' => 1,
//                 'credit_category' => 2
//            )
//        );
//        $this->insert(
//            '{{operation_types}}',
//            array(
//                 'name' => 'Expense',
//                 'debit_category' => 3,
//                 'credit_category' => 1
//            )
//        );
//        $this->insert(
//            '{{operation_types}}',
//            array(
//                 'name' => 'Transfer',
//                 'debit_category' => 1,
//                 'credit_category' => 1
//            )
//        );

        // This is not needed because of the yii-user module
        // use yiic migrate --migrationPath=user.migrations for the table before this migration
        // see - https://github.com/mishamx/yii-user/blob/master/README.md
        // see - http://www.yiiframework.com/extension/yii-user/
//        $this->createTable(
//            '{{users}}',
//            array(
//                 'id'=>'pk',
//                 'username'=>'string NOT NULL',
//                 'passhash'=>'string NOT NULL'
//            ),
//            $standardOption
//        );
        $this->createTable(
            '{{categories}}',
            array(
                 'id'=>'pk',
//                 'type'=>'integer NOT NULL',
                 'type'=>'string NOT NULL',
                 'user'=>'integer NOT NULL',
                 'name'=>'string NOT NULL',
                 'starting_balance'=>'decimal',
                 'date_opened'=>'date',
            ),
            $standardOption
        );
//        $this->addForeignKey(
//            'fk_operation_type',
//            '{{categories}}',
//            'type',
//            '{{operation_types}}',
//            'id',
//            'RESTRICT',
//            'RESTRICT'
//        );
        $this->addForeignKey(
            'fk_user',
            '{{categories}}',
            'user',
            '{{users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable(
            '{{operations}}',
            array(
                 'id'=>'pk',
                 'user'=>'integer NOT NULL',
//                 'type'=>'integer NOT NULL',
                 'type'=>'string NOT NULL',
                 'datetime'=>'timestamp',
                 'sum'=>'decimal NOT NULL',
                 'debit_category'=>'integer NOT NULL',
                 'credit_category'=>'integer NOT NULL',
                 'debit_sum'=>'decimal',
                 'credit_sum'=>'decimal',
                 'comment'=>'text'
            ),
            $standardOption
        );
        $this->addForeignKey(
            'fk_operations_user',
            '{{operations}}',
            'user',
            '{{users}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
//        $this->addForeignKey(
//            'fk_operations_operation_type',
//            '{{operations}}',
//            'type',
//            '{{operation_types}}',
//            'id',
//            'RESTRICT',
//            'RESTRICT'
//        );
        $this->addForeignKey(
            'fk_operations_debit_categories',
            '{{operations}}',
            'debit_category',
            '{{categories}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );
        $this->addForeignKey(
            'fk_operations_credit_categories',
            '{{operations}}',
            'credit_category',
            '{{categories}}',
            'id',
            'RESTRICT',
            'RESTRICT'
        );
        return true;
    }

    public function down()
    {
        $this->dropTable('{{operations}}');
        $this->dropTable('{{categories}}');
//        $this->dropTable('{{operation_types}}');
//        $this->dropTable('{{category_types}}');

//        $this->dropTable('{{users}}');
        return true;
    }

    /*
     // Use safeUp/safeDown to do migration with transaction
     public function safeUp()
     {
     }

     public function safeDown()
     {
     }
     */
}