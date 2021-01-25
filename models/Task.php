<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $content
 * @property boolean $closed
 * @property string $created_at
 */
class Task extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->on(self::EVENT_AFTER_INSERT, [$this, 'notifyInsert']);
        $this->on(self::EVENT_AFTER_DELETE, [$this, 'notifyDelete']);
        parent::init();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'content'], 'filter', 'filter' => 'strip_tags'],
            ['name', 'trim'],
            [['name', 'content'], 'required'],
            ['content', 'string'],
            ['name', 'string', 'max' => 255],
            ['closed', 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'name' => 'Название',
            'content' => 'Текст',
            'closed' => 'Закрыта',
            'created_at' => 'Дата',
        ];
    }

    protected function notifyInsert($event)
    {
        $this->refresh();
        Yii::$app->notifier->send("Создана задача: {$this->name}", $this->content);
    }

    protected function notifyDelete($event)
    {
        Yii::$app->notifier->send("Удалена задача: {$this->name}", $this->content);
    }
}
