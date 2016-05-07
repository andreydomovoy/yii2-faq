<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View
 * @var $model ando\faq\models\FaqQA
 * @var $groups array
 * @var $langs array
 */

$this->title = Yii::t('faq', 'Update QA');
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Faq: Administration'), 'url' => ['/faq/admin/groups/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'QA: manage for group «{name}»', ['name' => StringHelper::truncate($model->group->name, 10)]), 'url' => ['/faq/admin/qa/index', 'gid' => $model->group->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-qa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
        'groups'    => $groups,
        'langs'     => $langs,
    ]) ?>

</div>
