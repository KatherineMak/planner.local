<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Task;

/**
 * TaskSearch represents the model behind the search form of `common\models\Task`.
 */
class TaskSearch extends Task
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'priority', 'periodicity', 'user_id', 'user_id_assigned', 'list_id'], 'integer'],
            [['name', 'start_time', 'end_time', 'add_day', 'close_day', 'description', 'tag'], 'safe'],
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
        $query = Task::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'priority' => $this->priority,
            'periodicity' => $this->periodicity,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'add_day' => $this->add_day,
            'close_day' => $this->close_day,
            'user_id' => $this->user_id,
            'user_id_assigned' => $this->user_id_assigned,
            'list_id' => $this->list_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }
}
