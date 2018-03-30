<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property string $id
 * @property string $name
 * @property string $status
 * @property string $priority
 * @property string $periodicity
 * @property string $start_time
 * @property string $end_time
 * @property string $add_day
 * @property string $close_day
 * @property string $description
 * @property string $tag
 * @property string $user_id
 * @property string $user_id_assigned
 * @property string $list_id
 *
 * @property Activity[] $activities
 * @property Tasklist $list
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'priority', 'periodicity', 'start_time', 'end_time', 'add_day', 'close_day', 'description', 'tag', 'user_id', 'user_id_assigned', 'list_id'], 'required'],
            [['status', 'priority', 'periodicity', 'user_id', 'user_id_assigned', 'list_id'], 'integer'],
            [['start_time', 'end_time', 'add_day', 'close_day'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['tag'], 'string', 'max' => 20],
            [['list_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasklist::className(), 'targetAttribute' => ['list_id' => 'id']],
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
            'status' => 'Status',
            'priority' => 'Priority',
            'periodicity' => 'Periodicity',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'add_day' => 'Add Day',
            'close_day' => 'Close Day',
            'description' => 'Description',
            'tag' => 'Tag',
            'user_id' => 'User ID',
            'user_id_assigned' => 'User Id Assigned',
            'list_id' => 'List ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivities()
    {
        return $this->hasMany(Activity::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getList()
    {
        return $this->hasOne(Tasklist::className(), ['id' => 'list_id']);
    }
}
