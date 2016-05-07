<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model ando\faq\models\FaqQA */

$this->title = Yii::t('faq', 'View QA');
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Faq: Administration'), 'url' => ['/faq/admin/groups/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'QA: manage for group «{name}»', ['name' => StringHelper::truncate($model->group->name, 10)]), 'url' => ['/faq/admin/qa/index', 'gid' => $model->group->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="faq-qa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('faq', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('faq', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('faq', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'question:html',
            'answer:html',
            'group.name',
            'created_at:relativetime',
            'updated_at:relativetime',
        ],
    ]) ?>

</div>
