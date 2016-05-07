<?php

namespace ando\faq\models\admin\groups;

use ando\faq\models\Faq;
use ando\faq\models\FaqLanguages;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use ando\faq\models\FaqGroups;
use yii\db\ActiveQuery;

/**
 * FaqGroupsSearch represents the model behind the search form about `ando\faq\models\FaqGroups`.
 */
class FaqGroupsSearch extends FaqGroups
{
    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['lang.code', 'lang.name']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lang_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'lang.code', 'lang.name'], 'safe'],
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
        $query = FaqGroups::find()->alias('groups')->with('lang');

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith(['lang' => function($query) {
            /** @var $query ActiveQuery */
            $query->from(['lang' => FaqLanguages::tableName()]);
        }]);

        // enable sorting for the related column lang.code and lang.name
        $dataProvider->sort->attributes['lang.code'] = [
            'asc' => ['lang.code' => SORT_ASC],
            'desc' => ['lang.code' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['lang.name'] = [
            'asc' => ['lang.name' => SORT_ASC],
            'desc' => ['lang.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'groups.id' => $this->id,
            'groups.lang_id' => $this->lang_id,
            'groups.created_at' => $this->created_at,
            'groups.updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere([Faq::like(), 'groups.name', $this->name]);
        $query->andFilterWhere([Faq::like(), 'lang.code', $this->getAttribute('lang.code')]);
        $query->andFilterWhere([Faq::like(), 'lang.name', $this->getAttribute('lang.name')]);

        return $dataProvider;
    }
}
