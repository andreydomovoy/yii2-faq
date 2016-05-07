<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model ando\faq\models\FaqGroups */
/* @var $langs array */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-groups-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textarea(['rows' => 10]) ?>

        <?= $form->field($model, 'lang_id')->dropDownList($langs)->label(Yii::t('faq', 'Select language')) ?>

        <?//= $form->field($model, 'created_at')->textInput() ?>

        <?//= $form->field($model, 'updated_at')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('faq', 'Create') : Yii::t('faq', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

</div>
