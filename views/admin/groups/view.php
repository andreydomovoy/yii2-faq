<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model ando\faq\models\FaqGroups */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Faq: Administration'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-groups-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?//= Html::a(Yii::t('faq', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?/*= Html::a(Yii::t('faq', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('faq', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */?>
    </p>

<!--    --><?//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'name',
//            'lang_id',
//            'created_at',
//            'updated_at',
//        ],
//    ]) ?>

</div>
