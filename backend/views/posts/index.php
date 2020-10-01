<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="container">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($model) {
            if($model->role->item_name == 'admin') {
                return ['class' => 'info'];
            }
        },
        'columns' => [
            
            ['class' => 'yii\grid\SerialColumn'],

            [
                'headerOptions' => ['width' => '20'],
                'attribute' => 'id',
                'label' => 'ID',
            ],
            'content:ntext',
            [
                'headerOptions' => ['width' => '20'],
                'attribute' => 'role.item_name',
                'label' => 'Роль',
            ],
            [
                'headerOptions' => ['width' => '30'],
                'attribute' => 'author_id',
                'label' => 'Пользователь',
                'value' => function( $data ) {
                    if($data->user)
                        return $data->user->username;  
                },
            ],
            [
                'attribute' => 'status',
                'label' => 'Статус',
                'value' => function( $data ) {
                    if($data->status == User::STATUS_INCORRECT) {
                        return 'INCORRECT';  
                    }
                    return 'CORRECT';   
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

