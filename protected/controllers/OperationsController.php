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
 */
class OperationsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                  'users'  => array('@'),
            ),
            array('deny', // deny all users
                  'users'=> array('*'),
            ),
        );
    }

    public function actionCreate()
    {
        $model = new Operation;

        // Uncomment the following line if AJAX validation is needed
              $this->performAjaxValidation($model);

        if (isset($_POST['Operation'])) {
            $model->attributes = $_POST['Operation'];
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    $operations = $this->getFilteredOperations();
                    $html = $this->renderPartial(
                        '_indexTablePartial', array(
                                                   'operationsDataProvider' => $operations,
                                                   'highlightModel'         => $model
                                              )
                    );
//                    $html = $this->renderPartial("_indexTableRow", array(
//                        'model' => $model,
//                    ), true);
//                    $attributeNames = 'id,datetime,type,sum,comment,debitCategory.name,creditCategory.name';
//                    $this->json_encode_with_relations($operations->getData(), $attributeNames);
                } else {
                    $this->redirect(array('view', 'id' => $model->id));
                }

            }
        }
    }

    /**
     * takes an array of models and their attributes names and outputs them as json. works with relations unlike CJSON::encode()
     * @param $models array an array of models, consider using $dataProvider->getData() here
     * @param $attributeNames string a comma delimited list of attribute names to output, for relations use relationName.attributeName
     * @return void doesn't return anything, but changes content type to json and outputs json and exits
     */

    function json_encode_with_relations($models, $attributeNames) {
        $attributeNames = explode(',', $attributeNames);

        $rows = array(); //the rows to output
        foreach ($models as $model) {
            $row = array(); //you will be copying in model attribute values to this array
            foreach ($attributeNames as $name) {
                $name = trim($name); //in case of spaces around commas
                $row[$name] = CHtml::value($model, $name); //this function walks the relations
            }
            $rows[] = $row;
        }
        //header('Content-type:application/json');
        echo CJSON::encode($rows);
        Yii::app()->end();
    }

    protected function performAjaxValidation($model)
    {
//        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
        if (isset($_POST['ajax'])) {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }


    public function actionDelete()
    {
        $this->render('delete');
    }

    public function actionIndex()
    {
        $this->render(
            'index',
            array(
                 'operationsDataProvider' => $this->getFilteredOperations(),
            )
        );
    }

    public function actionUpdate()
    {
        $this->render('update');
    }

    public function actionFilter($id)
    {
        Yii::app()->user->setState('operations_filter', $id);
        $operations = $this->getFilteredOperations();
        $html = $this->renderPartial(
            '_indexTablePartial',
            array(
                 'operationsDataProvider' => $operations
            )
        );
    }

    /**
     * Returns the provider with the custom settings (filter and sorting)
     *
     * @return CActiveDataProvider
     */
    private function getFilteredOperations()
    {
        $filter = Yii::app()->user->getState('operations_filter');
        // Default settings - all operations
        $pagination = false;
        $criteria = new CDbCriteria(array(
            'order'    => 'datetime desc',
            //                 'with'     => array('userToProject'=> array('alias'=> 'user')),
//            'limit'    => -1,
        ));
        switch ($filter) {
            case 2:
                // Last 20 operations
                $criteria->limit = 2;
                break;
            case 3:
                // This month
                $lastMonth = date("m", mktime(0, 0, 0, date("m"), 0, date("Y")));
//                $criteriaArray['condition'] = "datetime > " . mktime();
                $start = strtotime('first day of this month');
                $end = strtotime('midnight last day of this month');
                $criteria->addBetweenCondition('datetime', date('Y-m-d',$start), date('Y-m-d', $end));
                break;
        }
        $operationsDataProvider = new CActiveDataProvider(
            'Operation',
            array(
                 'criteria'  => $criteria,
                 'pagination'=> $pagination,
                 //                 'pagination' => array('pageSize' => 20,),
                 //                 'totalItemCount' => 2,
            )
        );
        return $operationsDataProvider;
    }

    // Uncomment the following methods and override them if needed
    /*
     public function filters()
     {
         // return the filter configuration for this controller, e.g.:
         return array(
             'inlineFilterName',
             array(
                 'class'=>'path.to.FilterClass',
                 'propertyName'=>'propertyValue',
             ),
         );
     }

     public function actions()
     {
         // return external action classes, e.g.:
         return array(
             'action1'=>'path.to.ActionClass',
             'action2'=>array(
                 'class'=>'path.to.AnotherActionClass',
                 'propertyName'=>'propertyValue',
             ),
         );
     }
     */

    public function getFilterOptions(){
        return array(
            '1' => __("All", 'operatons'),
            '2' => __("Last 20 records", 'operatons'),
            '3' => __("This month", 'operatons'),
        );
    }
}