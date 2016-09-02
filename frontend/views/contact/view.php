<?php

/* @var $this yii\web\View */
/* @var $model common\models\Contact */
/* @var $model common\models\Phone */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

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
        <div class="col-lg-6">
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
        <div class="col-lg-3 col-lg-offset-1">

            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Добавить телефон
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse out">
                        <div class="panel-body bg-default">
                            <?php $form = ActiveForm::begin([
                                'options' => [
                                    'class' => 'form'
                                ]
                            ]); ?>
                            <?= $form->field($phone, 'number') ?>
                            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
