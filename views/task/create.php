<?php

/* @var yii\web\View $this */
/* @var app\models\Task $model */

$this->title = 'Новая задача';
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', ['model' => $model]);
