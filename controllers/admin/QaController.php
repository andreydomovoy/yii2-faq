<?php

namespace ando\faq\controllers\admin;

use ando\faq\models\FaqGroups;
use Yii;
use ando\faq\models\FaqQA;
use ando\faq\models\admin\qa\FaqQASearch;
use yii\db\ActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QAController implements the CRUD actions for FaqQA model.
 */
class QaController extends Controller
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
     * Lists all FaqQA models.
     * @var $gid integer group id
     * @return mixed
     */
    public function actionIndex($gid)
    {
        // find group
        $group =  $this->findModel($gid, FaqGroups::className());

        $searchModel = new FaqQASearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['group_id' => $group->id]);

        return $this->render('index', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'group'         => $group
        ]);
    }

    /**
     * Displays a single FaqQA model.
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
     * Creates a new FaqQA model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @var $id integer group id
     * @return mixed
     */
    public function actionCreate($gid)
    {
        // find group
        $group =  $this->findModel($gid, FaqGroups::className());
        $model = new FaqQA();
        $model->scenario = FaqQA::SCENARIO_CREATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model'     => $model,
                'group'     => $group,
                'groups'    => FaqGroups::fetchAll(),
            ]);
        }
    }

    /**
     * Updates an existing FaqQA model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = FaqQA::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model'  => $model,
                'groups' => FaqGroups::fetchAll(),
            ]);
        }
    }

    /**
     * Deletes an existing FaqQA model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $gid = $model->group->id;
        $model->delete();

        return $this->redirect(['index', 'gid' => $gid]);
    }

    /**
     * Finds the FaqQA model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param $class ActiveRecord
     * @return FaqQA the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $class = null)
    {
        $class = !isset($class) ? FaqQA::className() : $class;

        if (($model = $class::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
