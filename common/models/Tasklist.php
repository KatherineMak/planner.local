<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tasklist".
 *
 * @property string $id
 * @property string $name
 * @property string $priority
 * @property string $project_id
 *
 * @property Task[] $tasks
 * @property Project $project
 */
class Tasklist extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasklist';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'priority'], 'required'],
            [['priority', 'project_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'priority' => 'Priority',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['list_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
