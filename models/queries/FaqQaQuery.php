<?php

namespace ando\faq\models\queries;

/**
 * This is the ActiveQuery class for [[\ando\faq\models\FaqQa]].
 *
 * @see \ando\faq\models\FaqQa
 */
class FaqQaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \ando\faq\models\FaqQa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \ando\faq\models\FaqQa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
