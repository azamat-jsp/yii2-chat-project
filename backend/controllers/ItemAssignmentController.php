<?php

namespace backend\controllers;

use Yii;
use common\models\ItemAssignment;
use common\models\AuthItem;
use common\models\User;
use common\models\ItemAssignmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ItemAssignmentController implements the CRUD actions for ItemAssignment model.
 */
class ItemAssignmentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ItemAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!\Yii::$app->user->can('per_admin_back')) {
            throw new ForbiddenHttpException('Access denied');
        }

        $searchModel = new ItemAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing ItemAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($item_name, $user_id)
    {
        if (!\Yii::$app->user->can('per_admin_back')) {
            throw new ForbiddenHttpException('Access denied');
        }

        $model = $this->findModel($item_name, $user_id);

        $roles = AuthItem::find()->where(['type' => 1])->all();
        $rolesItems = ArrayHelper::map($roles,'name','name');
        $rolesItems = ArrayHelper::map($roles,'name','name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        }

        return $this->render('update', [
            'model' => $model,
            'rolesItems' => $rolesItems,
        ]);
    }


    /**
     * Finds the ItemAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $user_id
     * @return ItemAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = ItemAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
