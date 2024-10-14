<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "release_forms".
 *
 * @property int $id
 * @property string $name_release Форма выпуска
 *
 * @property Releases[] $releases
 */
class ReleaseForms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'release_forms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_release'], 'required'],
            [['name_release'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_release' => 'Name Release',
        ];
    }

    /**
     * Gets query for [[Releases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReleases()
    {
        return $this->hasMany(Releases::class, ['release_form_id' => 'id']);
    }
}
