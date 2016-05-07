<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model ando\faq\models\FaqGroups */
/* @var $langs array */

$this->title = Yii::t('faq', 'Update group: «{name}»', [
    'name' =>  StringHelper::truncate($model->name, 30),
]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Faq: Administration'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('faq', 'Update');
?>
<div class="faq-groups-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'langs' => $langs
    ]) ?>

</div>
