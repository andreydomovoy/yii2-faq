<?php
/**
 * @var $groups \ando\faq\models\FaqGroups[] All Groups with current language
 * @var $group \ando\faq\models\FaqGroups Current group
 * @var $model \ando\faq\models\FaqSearch
 */

use yii\helpers\Html;

$this->title = Yii::t('faq', 'FAQ');
$this->params['breadcrumbs'][] = $this->title;

?>


<?= $this->render('_search', ['model' => $model ]) ?>

<div class="col-sm-4">
    <?php foreach ($groups as $g): ?>
        <h5><?= Html::a($g->name, ['index', 'gid' => $g->id], ['class' => 'faq-group-link']) ?></h5>
    <?php endforeach; ?>
</div>

<div class="col-sm-8">
    <h3 class="text-primary"><?= $group->name ?></h3>
    <hr>
    <br>
    <?php if (count($group->faqQas)): ?>
        <?php foreach ($group->faqQas as $qa): ?>
            <h4><?= $qa->question ?></h4>
            <h6><?= $qa->answer ?></h6>
            <br>
        <?php endforeach; ?>
    <?php else: ?>
            <h5><?= Yii::t('faq', 'No QA founded') ?></h5>
    <?php endif; ?>
</div>
