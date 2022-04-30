<?php

namespace common\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $preview_image
 * @property int|null $status
 *
 * @property Post[] $posts
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_UNLISTED = 0;
    const STATUS_PUBLISHED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
                'ensureUnique' => true
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_UNLISTED]],
            [['description'], 'string'],
            [['status'], 'default', 'value' => self::STATUS_UNLISTED],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['preview_image'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'preview_image' => Yii::t('app', 'Preview Image'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public function getStatusLabels() {
        return [
            self::STATUS_UNLISTED => 'Draft',
            self::STATUS_PUBLISHED => 'Published'
        ];
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery|PostQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoryQuery(get_called_class());
    }
}
