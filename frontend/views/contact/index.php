<?php

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = 'Контакты';
?>
<div class="site-index">

    <div class="jumbotron"></div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <h2>Контакты</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">

                <?php

                $dataProvider = new ActiveDataProvider([
                    'query' => $model::find(),
                    'pagination' => [
                        'pageSize' => 30,
                    ],
                ]);

                \yii\widgets\Pjax::begin([
                    'enablePushState'=>false
                ]);

                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns'=>[
                        //'id',
                        [
                            'attribute' => 'name',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return Html::a($data->name, ['contact/view', 'id' => $data->id], ['data-pjax'=>'0']);
                            },
                        ],
                        [
                            'attribute'=>'create_date',
                            'label'=>'Добавлен',
                            'value'=>function ($data) {
                                return Yii::$app->formatter->asDate($data->create_date, 'd MMM Y hh:mm');
                            },
                        ],
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $data) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::toRoute(['contact/delete/', 'id'=>$data->id]), [
                                        'title'=>'Удалить',
                                        'data' => [
                                            'method' => 'post',
                                            'confirm' => "Вы действительно хотите удалить этот контакт?",
                                        ],
                                        'data-pjax' => 'w0'
                                    ]);
                                },
                            ],
                            'contentOptions' => ['class' => 'text-center', 'style' => 'max-width:20px;'],
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
                                    Добавить контакт
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse out">
                            <div class="panel-body bg-default">
                                <?php $form = ActiveForm::begin([
                                    'id' => 'add-contact',
                                    'action' => ['contact/create'],
                                    'options' => [
                                        'class' => 'form'
                                    ]
                                ]); ?>
                                <?= $form->field($model, 'name') ?>
                                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </div>
</div>
