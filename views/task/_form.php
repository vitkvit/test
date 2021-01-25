<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $this yii\web\View */
/* @var app\models\Task $model */

$form = ActiveForm::begin() ?>
<div class="row">
    <div class="col-md-12">
        <?php
        echo $form->field($model, 'name')->textInput(['maxlength' => 255]);
        echo $form->field($model, 'content')->textarea();
        echo $form->field($model, 'closed')->checkbox();
        ?>
        <div class="form-group">
            <?= Html::submitButton('Запомнить', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Отказаться', ['index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end() ?>
