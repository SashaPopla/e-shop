<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_lang".
 *
 * @property int $id
 * @property string $lang
 * @property string $title
 * @property string $description
 *
 * @property Product $id0
 */
class ProductLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'lang', 'title', 'description'], 'required'],
            [['id'], 'integer'],
            [['description'], 'string'],
            [['lang'], 'string', 'max' => 16],
            [['title'], 'string', 'max' => 255],
            [['id', 'lang'], 'unique', 'targetAttribute' => ['id', 'lang']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app_lang', 'ID'),
            'lang' => Yii::t('app_lang', 'Lang'),
            'title' => Yii::t('app_lang', 'Title'),
            'description' => Yii::t('app_lang', 'Description'),
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Product::className(), ['id' => 'id']);
    }
}
