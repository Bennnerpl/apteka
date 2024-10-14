<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "releases".
 *
 * @property int $id
 * @property int $product_id
 * @property int $release_form_id
 * @property int|null $dosage_id
 *
 * @property Products $dosage
 * @property Products $product
 * @property Products[] $products
 * @property ReleaseForms $releaseForm
 */
class Releases extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'releases';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'release_form_id'], 'required'],
            [['product_id', 'release_form_id', 'dosage_id'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
            [['dosage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['dosage_id' => 'dosage_id']],
            [['release_form_id'], 'exist', 'skipOnError' => true, 'targetClass' => ReleaseForms::class, 'targetAttribute' => ['release_form_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'release_form_id' => 'Release Form ID',
            'dosage_id' => 'Dosage ID',
        ];
    }

    /**
     * Gets query for [[Dosage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosage()
    {
        return $this->hasOne(Products::class, ['dosage_id' => 'dosage_id']);
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
        return $this->hasMany(Products::class, ['form_id' => 'id']);
    }

    /**
     * Gets query for [[ReleaseForm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReleaseForm()
    {
        return $this->hasOne(ReleaseForms::class, ['id' => 'release_form_id']);
    }
}
