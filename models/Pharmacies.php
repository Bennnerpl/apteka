<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pharmacies".
 *
 * @property int $id ID
 * @property string $name Название аптеки
 * @property string $address Адрес аптеки
 *
 * @property Stocks[] $stocks
 */
class Pharmacies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pharmacies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address'], 'required'],
            [['name', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
        ];
    }

    /**
     * Gets query for [[Stocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stocks::class, ['name_pharmacy' => 'id']);
    }
}
