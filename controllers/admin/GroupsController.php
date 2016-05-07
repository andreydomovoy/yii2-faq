<?php

namespace ando\faq\controllers\admin;

use ando\faq\models\FaqLanguages;
use Yii;
use ando\faq\models\FaqGroups;
use ando\faq\models\admin\groups\FaqGroupsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupsController implements the CRUD actions for FaqGroups model.
 */
class GroupsController extends Controller
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
     * Lists all FaqGroups models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FaqGroupsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FaqGroups model.
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
     * Creates a new FaqGroups model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FaqGroups();
        $model->scenario = FaqGroups::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/faq/admin/qa/index', 'gid' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'langs' => FaqLanguages::fetchAll()
            ]);
        }
    }

    /**
     * Updates an existing FaqGroups model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = FaqGroups::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/faq/admin/groups/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'langs' => FaqLanguages::fetchAll()
            ]);
        }
    }

    /**
     * Deletes an existing FaqGroups model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaqGroups model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaqGroups the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaqGroups::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
