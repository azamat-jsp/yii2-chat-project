<?php
namespace common\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $item_name
 * @property int $user_id
 * @property int $created_at
 */
class ItemAssignment extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'auth_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['item_name', 'user_id'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'item_name' => 'Имя роли',
            'user_id' => 'Пользователь',
            'created_at' => 'Дата создания',

        ];
    }
    

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}
