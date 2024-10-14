<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $name Торговое название
 * @property string $name_world Международное название
 * @property int $indications_id id показания к применению
 * @property int|null $form_id id формы выпуска
 * @property int|null $dosage_id id дозировки
 * @property int|null $price Цена
 *
 * @property Dosages $dosage
 * @property Releases $form
 * @property UsesReccommend $indications
 * @property OrderItems $orderItems
 * @property Releases $releases
 * @property Releases $releases0
 * @property Stocks $stocks
 * @property UsesReccommend $usesReccommends
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_world', 'indications_id'], 'required'],
            [['indications_id', 'form_id', 'dosage_id', 'price'], 'integer'],
            [['name', 'name_world'], 'string', 'max' => 255],
            [['dosage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Dosages::class, 'targetAttribute' => ['dosage_id' => 'id']],
            [['form_id'], 'exist', 'skipOnError' => true, 'targetClass' => Releases::class, 'targetAttribute' => ['form_id' => 'id']],
            [['indications_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsesReccommend::class, 'targetAttribute' => ['indications_id' => 'id']],
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
            'name_world' => 'Name World',
            'indications_id' => 'Indications ID',
            'form_id' => 'Form ID',
            'dosage_id' => 'Dosage ID',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Dosage]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosage()
    {
        return $this->hasOne(Dosages::class, ['id' => 'dosage_id']);
    }

    /**
     * Gets query for [[Form]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getForm()
    {
        return $this->hasOne(Releases::class, ['id' => 'form_id']);
    }

    /**
     * Gets query for [[Indications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndications()
    {
        return $this->hasOne(UsesReccommend::class, ['id' => 'indications_id']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::class, ['order_product_id' => 'id']);
    }

    /**
     * Gets query for [[Releases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReleases()
    {
        return $this->hasMany(Releases::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Releases0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReleases0()
    {
        return $this->hasMany(Releases::class, ['dosage_id' => 'dosage_id']);
    }

    /**
     * Gets query for [[Stocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stocks::class, ['name' => 'id']);
    }

    /**
     * Gets query for [[UsesReccommends]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsesReccommends()
    {
        return $this->hasMany(UsesReccommend::class, ['product_id' => 'id']);
    }
}
