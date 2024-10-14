<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stocks".
 *
 * @property int $id
 * @property int|null $name Название препарата
 * @property int|null $name_pharmacy Название аптеки
 * @property int $quantity Остаток товаров в аптеке
 *
 * @property Products $name0
 * @property Pharmacies $namePharmacy
 */
class Stocks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_pharmacy', 'quantity'], 'integer'],
            [['quantity'], 'required'],
            [['name_pharmacy'], 'exist', 'skipOnError' => true, 'targetClass' => Pharmacies::class, 'targetAttribute' => ['name_pharmacy' => 'id']],
            [['name'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['name' => 'id']],
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
            'name_pharmacy' => 'Name Pharmacy',
            'quantity' => 'Quantity',
        ];
    }

    /**
     * Gets query for [[Name0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getName0()
    {
        return $this->hasOne(Products::class, ['id' => 'name']);
    }

    /**
     * Gets query for [[NamePharmacy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNamePharmacy()
    {
        return $this->hasOne(Pharmacies::class, ['id' => 'name_pharmacy']);
    }
}
