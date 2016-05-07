<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model ando\faq\models\FaqQA */
/** @var $groups array */
/** @var $group \ando\faq\models\FaqGroups */

$this->title = Yii::t('faq', 'Create a question/answer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Faq: Administration'), 'url' => ['/faq/admin/groups/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'QA: manage for group «{name}»', ['name' => StringHelper::truncate($group->name, 10)]), 'url' => ['/faq/admin/qa/index', 'gid' => $group->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-qa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'groups' => $groups,
        'group' => $group
    ]) ?>

</div>
