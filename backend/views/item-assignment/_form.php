<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ItemAssignment */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="item-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->dropDownList($rolesItems)->label('Роли') ?>

    <?= $form->field($model, 'user_id')->textInput(['disabled' => true])->label('Пользователь') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
