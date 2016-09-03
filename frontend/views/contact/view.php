<?php

/* @var $this yii\web\View */
/* @var $model common\models\Contact */
/* @var $model common\models\Phone */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="jumbotron"></div>

<div class="contact-view">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="row">
        <div class="col-lg-4">
            <p>
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="btn btn-primary">
                    Изменить
                </a>
                <?= Html::a('Удалить', ['contact/delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить этот телефон?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <div id="collapseTwo" class="panel-group collapse out">
                <div class="panel panel-default">
                    <div class="panel-body bg-default">
                        <?php $form = ActiveForm::begin([
                            'id' => 'update-contact',
                            'action' => Url::toRoute(['contact/update', 'id'=>$model->id]),
                            'options' => [
                                'class' => 'form'
                            ]
                        ]); ?>
                        <?= $form->field($model, 'name') ?>
                        <?= Html::submitButton('Готово', ['class' => 'btn btn-primary']) ?>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

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
                                return Html::a($data->number, urlencode('tel:'.$data->number));
                            },
                        ],
                        [
                            'attribute' => 'create_date',
                            'header' => 'Добавлен',
                            'value' => function ($data) {
                                return
                                    Yii::$app->formatter->asDate($data->create_date, 'd MMM Y').
                                    ' *** '.
                                    Yii::$app->formatter->asDate($data->create_date, 'hh:mm');
                            },
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $data) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::toRoute(['phone/delete/', 'id'=>$data->id]), [
                                        'title'=>'Удалить',
                                        'data' => [
                                            'method' => 'post',
                                            'confirm' => "Вы действительно хотите удалить этот телефон?",
                                        ],
                                        'data-pjax' => 'w0'
                                    ]);
                                },
                            ],
                            'contentOptions' => ['class' => 'text-center', 'style' => 'width:20px;'],
                        ]
                    ],
                ]);

                \yii\widgets\Pjax::end();
            ?>
        </div>
        <div class="col-lg-4 col-lg-offset-1">

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
                                'id' => 'add-phone',
                                'action' => ['phone/create'],
                                'options' => [
                                    'class' => 'form'
                                ]
                            ]); ?>
                            <?= $form->field($phone, 'contact_id')->hiddenInput(['value' => $model->id])->label(false); ?>
                            <?= $form->field($phone, 'number')->widget(\yii\widgets\MaskedInput::className(), [
                                'mask' => '+7 (999) 999 99-99',
                            ]) ?>
                            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
