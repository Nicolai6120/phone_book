<?php

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="jumbotron"></div>

<div class="contact-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот телефон?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-lg-8">
            <?php
                $dataProvider = new ActiveDataProvider([
                    'query' => $model->getPhones(),
                    'pagination' => [
                        'pageSize' => 30,
                    ],
                ]);

                \yii\widgets\Pjax::begin([
                    'enablePushState'=>false
                ]);

                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        //'id',
                        [
                            'attribute' => 'number',
                            'header' => 'Номер',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::a($data->number, 'tel:'.$data->number);
                            },
                        ],
                        [
                            'attribute' => 'create_date',
                            'header' => 'Добавлен',
                            'value' => function ($data) {
                                return Yii::$app->formatter->asDate($data->create_date, 'd MMM Y');
                            },
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'title' =>'Удалить',
                                        'data-confirm'=>"Вы действительно хотите удалить этот контакт?",
                                        'data-pjax'=>'1'
                                    ]);
                                },
                            ],
                            'contentOptions' => ['class' => 'text-center', 'style' => 'max-width:20px;'],

                            'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'delete') {
                                    $url ='/panel/adverts/edition/delete/'.$model->id;
                                    return $url;
                                }
                            }
                        ]
                    ],
                ]);

                \yii\widgets\Pjax::end();
            ?>
        </div>
    </div>

</div>
