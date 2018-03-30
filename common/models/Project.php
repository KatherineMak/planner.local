<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property string $id
 * @property string $name
 * @property string $organization_id
 *
 * @property Organization $organization
 * @property Tasklist[] $tasklists
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'organization_id'], 'required'],
            [['organization_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organization::className(), 'targetAttribute' => ['organization_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'organization_id' => Yii::t('app', 'Organization ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organization::className(), ['id' => 'organization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasklists()
    {
        return $this->hasMany(Tasklist::className(), ['project_id' => 'id']);
    }
}
