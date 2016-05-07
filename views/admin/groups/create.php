<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model ando\faq\models\FaqGroups */
/* @var $langs ando\faq\models\FaqLanguages */

$this->title = Yii::t('faq', 'Add new group');
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Faq: Administration'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-groups-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'langs' => $langs
    ]) ?>

</div>
