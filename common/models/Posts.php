<?php

namespace common\models;

use common\models\User;
use common\models\ItemAssignment;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $title
 * @property string|null $content
 * @property int $author_id
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'status'], 'required'],
            [['content'], 'string'],
            [['author_id', 'status'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Контент',
            'status' => 'Статус',
        ];
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getRole()
    {
        return $this->hasOne(ItemAssignment::className(), ['user_id' => 'author_id']);
    }
}
