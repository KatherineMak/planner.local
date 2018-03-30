<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity".
 *
 * @property string $id
 * @property string $user_id
 * @property string $task_id
 * @property string $description
 *
 * @property Task $task
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id', 'description'], 'required'],
            [['user_id', 'task_id'], 'integer'],
            [['description'], 'string', 'max' => 200],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'task_id' => Yii::t('app', 'Task ID'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['id' => 'task_id']);
    }
}
