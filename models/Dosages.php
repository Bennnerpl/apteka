<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosages".
 *
 * @property int $id
 * @property string $dosage Дозировка
 *
 * @property Products[] $products
 */
class Dosages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dosage'], 'required'],
            [['dosage'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dosage' => 'Dosage',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['dosage_id' => 'id']);
    }
}
