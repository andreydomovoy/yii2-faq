<?php

namespace ando\faq\models;

use Yii;
use yii\behaviors\TimestampBehavior;


/**
 * This is the model class for table "{{%faq_languages}}".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property FaqGroups[] $faqGroups
 * @property FaqQa[] $faqQas
 */
class FaqLanguages extends Faq
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%faq_languages}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['code'], 'string', 'max' => 6],
            [['name'], 'string', 'max' => 30],
            [['code'], 'unique'],
            [['name'], 'unique'],
            [['code', 'name'], 'unique', 'targetAttribute' => ['code', 'name'], 'message' => 'The combination of Code and Name has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('faq', 'ID'),
            'code' => Yii::t('faq', 'Code'),
            'name' => Yii::t('faq', 'Language'),
            'created_at' => Yii::t('faq', 'Created At'),
            'updated_at' => Yii::t('faq', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqGroups()
    {
        return $this->hasMany(FaqGroups::className(), ['lang_id' => 'id'])->inverseOf('lang');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqQas()
    {
        return $this->hasMany(FaqQa::className(), ['lang_id' => 'id'])->inverseOf('lang');
    }

    /**
     * @inheritdoc
     * @return \ando\faq\models\queries\FaqLanguagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \ando\faq\models\queries\FaqLanguagesQuery(get_called_class());
    }

    /**
     * Return all languages that exists
     * @return array
     */
    public static function fetchAll() {
        $langs      = static::find()->all();
        $outLangs   = [];

        foreach($langs as $lang) {
            $outLangs[$lang->id] = "$lang->name ({$lang->code})";
        }

        return $outLangs;
    }
}
