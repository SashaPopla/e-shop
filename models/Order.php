<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\OrderItems;
use app\models\City;
use app\models\Mail;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $qty
 * @property float $sum
 * @property string $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $city
 * @property string $mail
 */
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['created_at', 'updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone', 'city', 'mail'], 'required'],
            [['qty'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['sum'], 'number'],
            [['status'], 'boolean'],
            ['phone', 'match', 'pattern' => '/^\d{10}$/i', 'message' => 'Неверный формат номера телефона. Пример: 0999999999'],
            [['name', 'email', 'phone', 'city', 'mail'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'E-main',
            'phone' => 'Телефон',
            'city' => 'Город',
            'mail' => 'Адресса пошти',
        ];
    }
}
