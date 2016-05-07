<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ando\faq\models\FaqQA */
/* @var $form yii\widgets\ActiveForm */
/** @var $groups array */
/** @var $group \ando\faq\models\FaqGroups */
?>

<div class="faq-qa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'group_id')->dropDownList($groups, ['options' => [$group->id => ['Selected' => true]]])->label(Yii::t('faq', 'Select group')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('faq', 'Create') : Yii::t('faq', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
