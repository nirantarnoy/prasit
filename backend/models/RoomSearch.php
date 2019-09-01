<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Room;

/**
 * RoomSearch represents the model behind the search form of `backend\models\Room`.
 */
class RoomSearch extends Room
{
    public $globalSearch;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'building_id', 'floor','room_status','pay_status', 'customer_id', 'rent_type', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['room_no', 'last_pay_date', 'photo'], 'safe'],
            [['room_rate', 'water_meter_last', 'elect_meter_last', 'water_per_unit', 'elect_per_unit'], 'number'],
            [['globalSearch'],'string'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Room::find();

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
            'building_id' => $this->building_id,
            'floor' => $this->floor,
            'customer_id' => $this->customer_id,
            'room_rate' => $this->room_rate,
            'rent_type' => $this->rent_type,
            'room_status' => $this->room_status,
            'pay_status' => $this->pay_status,
            'water_meter_last' => $this->water_meter_last,
            'elect_meter_last' => $this->elect_meter_last,
            'water_per_unit' => $this->water_per_unit,
            'elect_per_unit' => $this->elect_per_unit,
            'last_pay_date' => $this->last_pay_date,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);
        if($this->globalSearch != '') {
            $query->andFilterWhere(['like', 'room_no', $this->globalSearch])
                ->andFilterWhere(['like', 'photo', $this->photo]);
        }
        return $dataProvider;
    }
}
