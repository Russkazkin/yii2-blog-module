<?php


namespace app\modules\blog\models;


use app\modules\auth\models\User;
use app\modules\blog\models\base\BaseComment;
use app\modules\blog\Module;
use yii\behaviors\TimestampBehavior;

class Comment extends BaseComment
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return  [
            [['text', 'article_id'], 'required'],
            [['text'], 'string'],
            [['user_id', 'parent_id', 'article_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('blog', 'ID'),
            'text' => Module::t('blog', 'Text'),
            'user_id' => Module::t('blog', 'User ID'),
            'article_id' => Module::t('blog', 'Article ID'),
            'status' => Module::t('blog', 'Status'),
            'created_at' => Module::t('blog', 'Created At'),
            'updated_at' => Module::t('blog', 'Updated At'),
        ];
    }
}