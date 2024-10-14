<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "using_reccomends".
 *
 * @property int $id
 * @property string $name_reccommendation
 *
 * @property UsesReccommend[] $usesReccommends
 */
class UsingReccomends extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'using_reccomends';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_reccommendation'], 'required'],
            [['name_reccommendation'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_reccommendation' => 'Name Reccommendation',
        ];
    }

    /**
     * Gets query for [[UsesReccommends]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsesReccommends()
    {
        return $this->hasMany(UsesReccommend::class, ['reccomend_id' => 'id']);
    }
}
