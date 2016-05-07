<?php

namespace ando\faq\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\StringHelper;

/**
 * This is the model class for table "{{%faq_groups}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $lang_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property FaqLanguages $lang
 * @property FaqQa[] $faqQas
 */
class FaqGroups extends Faq
{
    const SCENARIO_CREATE = 'scenario-create';
    const SCENARIO_UPDATE = 'scenario-update';

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
        return '{{%faq_groups}}';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['name', 'lang_id'],
            self::SCENARIO_UPDATE => ['name', 'lang_id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'lang_id'], 'required'],
            [['lang_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'length' => [3, 255]],
            [['name'], 'unique', 'targetAttribute' => ['name', 'lang_id']],
            ['name', 'filter', 'filter' => function($value) {
                return strip_tags($value);
            }],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaqLanguages::className(), 'targetAttribute' => ['lang_id' => 'id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('faq', 'ID'),
            'name' => Yii::t('faq', 'Group Name'),
            'lang_id' => Yii::t('faq', 'Lang ID'),
            'created_at' => Yii::t('faq', 'Created At'),
            'updated_at' => Yii::t('faq', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(FaqLanguages::className(), ['id' => 'lang_id'])->inverseOf('faqGroups');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaqQas()
    {
        return $this->hasMany(FaqQa::className(), ['group_id' => 'id'])->inverseOf('group');
    }

    /**
     * @inheritdoc
     * @return \ando\faq\models\queries\FaqGroupsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \ando\faq\models\queries\FaqGroupsQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) return false;

        return true;
    }

    /**
     * Return all groups that exists
     * @return array
     */
    public static function fetchAll() {
        $groups     = static::find()->with('lang')->all();
        $outGroups  = [];

        foreach($groups as $group) {
            $outGroups[$group->id] = StringHelper::truncate($group->name, 50) . " [{$group->lang->name}/{$group->lang->code}]";
        }

        return $outGroups;
    }
}
