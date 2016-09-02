<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;

$this->title = 'Контакты';
?>
<div class="site-index">

    <div class="jumbotron"></div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-8">
                <h2>Контакты</h2>

                <?php

                    $dataProvider = new ActiveDataProvider([
                        'query' => $model,
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
                            'id',
                            'name',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'header'=>'Название контакта',
                                'format' => 'html',
                                'value' => function ($data) {
                                    return Html::a('<span class="fa fa-phone"></span>', $url, [
                                        'title' => $data->name,
                                    ]);
                                },
                            ],
                            'create_date',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'header'=>'Добавлен',
    //                            'value' => function ($data) {
    //                                return $data->create_date;
    //                            },
                            ],
                            'format',
                            [
                                'class' => ActionColumn::className(),
                                'template' => '{update} {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                            'title' => 'Редактировать',
                                        ]);
                                    },
                                    'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                            'title' =>'Удалить',
                                            'data-confirm'=>"Вы действительно хотите удалить этот контакт?",
                                            'data-pjax'=>'1'
                                        ]);
                                    },
                                ],

                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'update') {
                                        $url ='/panel/adverts/edition/update/'.$model->id;
                                        return $url;
                                    }
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
            <div class="col lg-4">
                <a class="btn btn-default" href="http://www.yiiframework.com/doc/">Добавить контакт</a>
            </div>
        </div>

    </div>
</div>
