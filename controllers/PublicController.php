<?php

namespace ando\faq\controllers;

use ando\faq\models\FaqGroups;
use ando\faq\models\FaqSearch;
use yii\web\Controller;
use yii;
use yii\web\NotFoundHttpException;

class PublicController extends Controller
{
    /**
     * Default action - show groups (and QA)
     * @param $gid integer group ID
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($gid = null) {

        // find all groups with current language
        $groups = FaqGroups::find()->byLangCode(Yii::$app->language)->all();

        // set default group
        if (!isset($gid) && isset($groups)) $gid = $groups[0]->id;

        // find current group
        $group = FaqGroups::find()->byLangAndId(Yii::$app->language, $gid)->one();
        if (!isset($group)) throw new NotFoundHttpException('Group(s) not found!');

        // render groups and QAs from current group
        return $this->render("index", [
            'groups'    => $groups,
            'group'     => $group,
            'model'     => new FaqSearch()
        ]);
    }

    /**
     * Action for search in QA
     * @return string
     */
    public function actionSearch() {

        $model  = new FaqSearch();
        $qas    = [];

        if ($model->load(Yii::$app->request->get())) {
            // find groups with current text
            $qas = $model->search();
        }

        return $this->render('results', [
            'model' => $model,
            'qas'   => $qas
        ]);
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