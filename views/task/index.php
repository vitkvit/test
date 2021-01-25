<?php

use yii\grid\ActionColumn;
use yii\bootstrap\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var app\models\search\TaskSearch $searchModel
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'Задачи';

echo Html::a(
    'Создать',
    ['create'],
    [
        'class' => 'btn btn-primary',
        'style' => 'margin-bottom: 10px;'
    ]
);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'layout' => "{items}\n{pager}",
    'tableOptions' => [
        'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'text-center'],
    ],
    'columns' => [
        'id',
        [
            'attribute' => 'name',
            'contentOptions' => ['class' => 'text-left'],
        ],
        'closed:boolean',
        [
            'attribute' => 'created_at',
            'format' => ['date', 'dd.MM HH:mm'],
        ],
        [
            'class' => ActionColumn::class,
            'header' => 'Действия',
            'template' => '{update} {delete}',
        ],
    ],
]);