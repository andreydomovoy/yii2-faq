<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel ando\faq\models\admin\groups\FaqGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Pjax::begin();

$this->title = Yii::t('faq', 'Faq: Administration');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="faq-groups-index">

    <h1><?= Html::encode($this->title) ?></h1><br>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('faq', 'Add group'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'format'    => 'html',
                'value'     => function($model) {
                    return Html::a($model->name, ['/faq/admin/qa/index', 'gid' => $model->id]);
                }
            ],
            'lang.code',
            'lang.name',
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return Yii::$app->formatter->asRelativeTime($model->created_at);
                },
                'filterInputOptions' => ['style' => 'display: none;']
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return Yii::$app->formatter->asRelativeTime($model->created_at);
                },
                'filterInputOptions' => ['style' => 'display: none;']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'  => '{update} {delete}'
            ],
        ],
    ]); ?>

</div>

<?php Pjax::end(); ?>
