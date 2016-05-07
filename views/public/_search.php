<?php

/**
 * @var $model \ando\faq\models\FaqSearch
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="col-sm-12">

    <?php

        $form = ActiveForm::begin([
            'options'   => ['class' => 'form-inline faq-search'],
            'action'    => 'search',
            'method'    => 'GET'
        ]);
    ?>

    <?= $form->field($model, 'text', ['inputOptions' => ['class' => 'form-control', 'placeholder' => Yii::t('faq', 'Text to search...')]])->label('') ?>

    <?= Html::submitButton(Yii::t('faq', 'Find'), ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
    <br>
    <br>
    <br>
</div>