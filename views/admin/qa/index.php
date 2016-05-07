<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $searchModel ando\faq\models\admin\qa\FaqQASearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $group \ando\faq\models\FaqGroups */

$this->title = Yii::t('faq', 'QA: manage «{name}» ({lang}/{code})', [
    'name'  => StringHelper::truncate($group->name, 30),
    'lang'  => $group->lang->name,
    'code'  => $group->lang->code,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Faq: Administration'), 'url' => ['/faq/admin/groups/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-qa-index">

    <h1><?= Html::encode($this->title) ?></h1><br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('faq', 'Add question/answer'), ['create', 'gid' => $group->id ], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'question:html',
            'answer:html',
            'group.name',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
