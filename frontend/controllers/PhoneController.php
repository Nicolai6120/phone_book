<?php

namespace frontend\controllers;

use Yii;
use common\models\Phone;
use common\models\PhoneSearch;
use common\models\Contact;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PhoneController implements the CRUD actions for Phone model.
 */
class PhoneController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Phone models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhoneSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Phone model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Phone model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $phone = new Phone();
        $phone->attributes = \Yii::$app->request->post('Contact');
        $phone->creator_ip = ip2long(\Yii::$app->request->userIP);

        if ($phone->load(Yii::$app->request->post()) && $phone->save()) {
            return $this->redirect(['/contact/view', 'id' => $phone->contact_id]);
        } else {
            $model = Contact::findOne($phone->contact_id);
            return $this->render('/contact/view', [
                'model' => $model,
                'phone' => $phone
            ]);
        }
    }

    /**
     * Updates an existing Phone model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Phone model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $phone = $this->findModel($id);
        $phone->delete();
        
        if (Yii::$app->getRequest()->isAjax) {
            $model = Contact::findOne($phone->contact_id);
            return $this->renderPartial('/contact/view', [
                'model' => $model
            ]);
        }
        return $this->redirect(['contact/view', 'id'=>$phone->contact_id]);
    }

    /**
     * Finds the Phone model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Phone the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Phone::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
