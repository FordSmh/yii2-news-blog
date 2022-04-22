<?php

namespace common\models;

use kartik\daterange\DateRangeBehavior;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form of `common\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'updated_by', 'status', 'category_id'], 'integer'],
            [['title', 'bodytext', 'preview_image'], 'safe'],
            [['created_by', 'created_at', 'updated_at'], 'string'],
            ['featured', 'boolean']
        ];
    }
    public $date_start = '';
    public $date_end = '';

    public function behaviors() {
        return [
            [
                'class' => DateRangeBehavior::class,
                'attribute' => 'created_at',
                'dateStartAttribute' => 'date_start',
                'dateEndAttribute' => 'date_end',
                'dateStartFormat' => 'Y-m-d',
                'dateEndFormat' => 'Y-m-d',

            ]
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
        $query = Post::find()
            ->alias('post')
            ->joinWith('createdBy as user');
        if(!\Yii::$app->user->can('admin')) {
            $query->andWhere('created_by = :userId')->addParams(['userId' => \Yii::$app->user->id]);
        }
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
            'featured' => $this->featured,
            'post.status' => $this->status,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'bodytext', $this->bodytext])
            ->andFilterWhere(['ilike', 'preview_image', $this->preview_image])
            ->andFilterWhere(['ilike', 'user.username', $this->created_by]);


        if($this->date_start && $this->date_end) {
            $query->andWhere("post.created_at BETWEEN SYMMETRIC '".$this->date_start."' AND '".$this->date_end."'");
        }

        return $dataProvider;
    }
}
