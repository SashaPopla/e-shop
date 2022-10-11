<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lang".
 *
 * @property int $id
 * @property string $url
 * @property string $local
 * @property string $name
 * @property int $default
 * @property int $date_update
 * @property int $date_create
 */
class Lang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['url', 'local', 'name', 'date_update', 'date_create'], 'required'],
            [['default', 'date_update', 'date_create'], 'integer'],
            [['url', 'local', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app_atribute', 'ID'),
            'url' => Yii::t('app_atribute', 'Url'),
            'local' => Yii::t('app_atribute', 'Local'),
            'name' => Yii::t('app_atribute', 'Name'),
            'default' => Yii::t('app_atribute', 'Default'),
            'date_update' => Yii::t('app_atribute', 'Date Update'),
            'date_create' => Yii::t('app_atribute', 'Date Create'),
        ];
    }

    public static function getLanguages()
    {
        return self::find()->all();
    }
}
