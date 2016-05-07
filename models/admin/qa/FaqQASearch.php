<?php

namespace ando\faq\models\admin\qa;

use ando\faq\models\Faq;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ando\faq\models\FaqQA;
use ando\faq\models\FaqGroups;
use yii\db\ActiveQuery;

/**
 * FaqQASearch represents the model behind the search form about `ando\faq\models\FaqQA`.
 */
class FaqQASearch extends FaqQA
{
    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['group.name']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'created_at', 'updated_at'], 'integer'],
            [['question', 'answer', 'group.name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FaqQA::find()->alias('qa')->with(['group']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['group' => function($query) {
            /** @var $query ActiveQuery */
            $query->from(['group' => FaqGroups::tableName()]);
        }]);

        // enable sorting for the related column lang.code and lang.name
        $dataProvider->sort->attributes['group.name'] = [
            'asc' => ['group.name' => SORT_ASC],
            'desc' => ['group.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'qa.id' => $this->id,
            'qa.group_id' => $this->group_id,
            'qa.created_at' => $this->created_at,
            'qa.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere([Faq::like(), 'question', $this->question])
                ->andFilterWhere([Faq::like(), 'answer', $this->answer])
                ->andFilterWhere([Faq::like(), 'group.name', $this->getAttribute('group.name')]);

        return $dataProvider;
    }
}
