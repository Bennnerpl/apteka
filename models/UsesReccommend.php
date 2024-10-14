<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uses_reccommend".
 *
 * @property int $id
 * @property int|null $reccomend_id
 * @property int|null $product_id
 *
 * @property Products $product
 * @property Products[] $products
 * @property UsingReccomends $reccomend
 */
class UsesReccommend extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uses_reccommend';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reccomend_id', 'product_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
            [['reccomend_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsingReccomends::class, 'targetAttribute' => ['reccomend_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reccomend_id' => 'Reccomend ID',
            'product_id' => 'Product ID',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::class, ['indications_id' => 'id']);
    }

    /**
     * Gets query for [[Reccomend]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReccomend()
    {
        return $this->hasOne(UsingReccomends::class, ['id' => 'reccomend_id']);
    }
}
