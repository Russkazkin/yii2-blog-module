<?php


namespace app\modules\blog\models;


use yii2mod\comments\models\CommentModel;

class Comment extends CommentModel
{
    public static function tableName()
    {
        return 'blog_comment';
    }
}