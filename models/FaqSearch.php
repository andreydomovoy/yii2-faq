<?php

namespace ando\faq\models;

use yii;
use yii\base\Model;

class FaqSearch extends Model
{
    public $text;

    public function attributeLabels()
    {
        return [
            'text' => Yii::t('faq', 'Text to search')
        ];
    }

    public function rules()
    {
        return [
            ['text', 'required'],
            ['text', 'string', 'min' => '3'],
        ];
    }

    /**
     * Search by question/answer
     * @return bool
     * @throws
     */
    public function search() {
        if (!$this->validate()) return false;

        // find current language
        /** @var $lang FaqLanguages */
        $lang = FaqLanguages::findOne(['[[code]]' => Yii::$app->language]);

        // if no current language in db - return empty results
        if (!isset($lang)) return [];

        return

        FaqQa::find()
            ->with('group')
            ->joinWith(['group' => function ($query) use ( $lang ) {
                /** @var $query yii\db\ActiveQuery */
                return $query
                    ->from(['group' => FaqGroups::tableName()])
                    ->andWhere('[[group.lang_id]] = :langID', [':langID' => $lang->id]);
            }])
            ->andWhere([Faq::like(), 'question', $this->text])
            ->orWhere([Faq::like(), 'answer', $this->text])
            ->all();
    }
}