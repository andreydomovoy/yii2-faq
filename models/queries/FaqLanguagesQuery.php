<?php

namespace ando\faq\models\queries;

/**
 * This is the ActiveQuery class for [[\ando\faq\models\FaqLanguages]].
 *
 * @see \ando\faq\models\FaqLanguages
 */
class FaqLanguagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \ando\faq\models\FaqLanguages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \ando\faq\models\FaqLanguages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
