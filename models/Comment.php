<?php


namespace app\modules\blog\models;


use Yii;
use yii2mod\comments\models\CommentModel;
use yii2mod\moderation\enums\Status;

class Comment extends CommentModel
{
    public static function tableName()
    {
        return 'blog_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity', 'entityId'], 'required'],
            ['content', 'required', 'message' => Yii::t('yii2mod.comments', 'Comment cannot be blank.')],
            [['content', 'entity', 'relatedTo', 'url'], 'string'],
            ['status', 'default', 'value' => Status::APPROVED],
            ['status', 'in', 'range' => Status::getConstantsByName()],
            ['level', 'default', 'value' => 1],
            ['parentId', 'validateParentID', 'except' => static::SCENARIO_MODERATION],
            [['entityId', 'parentId', 'status', 'level'], 'integer'],
        ];
    }
}