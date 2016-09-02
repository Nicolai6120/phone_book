<?php

/* @var $this yii\web\View */
/* @var $model common\models\Contact */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
            <div class="col-lg-7">

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
                            'attribute' => 'create_date',
                            'label'=>'Добавлен',
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
                <a class="btn btn-default" href="http://www.yiiframework.com/doc/">Добавить контакт</a>

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'name') ?>
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div>
