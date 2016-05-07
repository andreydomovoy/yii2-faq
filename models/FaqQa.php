<?php

namespace ando\faq\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%faq_qa}}".
 *
 * @property integer $id
 * @property string $question
 * @property string $answer
 * @property integer $group_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property FaqGroups $group
 * @property FaqLanguages $lang
 */
class FaqQa extends Faq
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
        return '{{%faq_qa}}';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['question', 'answer', 'group_id'],
            self::SCENARIO_UPDATE => ['question', 'answer', 'group_id'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'answer', 'group_id'], 'required'],
            [['question', 'answer'], 'string', 'min' => 2],
            [['group_id', 'created_at', 'updated_at'], 'integer'],
            [['question'], 'unique', 'targetAttribute' => ['question', 'group_id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => FaqGroups::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['question', 'answer'], 'filter', 'filter' => function($value) {
                return Yii::$app->formatter->asHtml($value, [
                    'Core.RemoveProcessingInstructions' => true,
                    'Core.EscapeInvalidTags'            => true,
                    'AutoFormat.RemoveEmpty'            => true,
                    'Attr.AllowedFrameTargets'          => ['_blank'],
                    'HTML.AllowedElements'              => 'a,p,b,strong,em,i'
                ]);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('faq', 'ID'),
            'question' => Yii::t('faq', 'Question'),
            'answer' => Yii::t('faq', 'Answer'),
            'group_id' => Yii::t('faq', 'Group ID'),
            'created_at' => Yii::t('faq', 'Created At'),
            'updated_at' => Yii::t('faq', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(FaqGroups::className(), ['id' => 'group_id'])->inverseOf('faqQas');
    }

    /**
     * @inheritdoc
     * @return \ando\faq\models\queries\FaqQaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \ando\faq\models\queries\FaqQaQuery(get_called_class());
    }
}
