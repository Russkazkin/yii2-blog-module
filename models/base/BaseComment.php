<?php

namespace app\modules\blog\models\base;

use app\modules\blog\models\Article;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "blog_comment".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property int $article_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Article $article
 */
class BaseComment extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'user_id', 'article_id'], 'required'],
            [['text'], 'string'],
            [['user_id', 'article_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::class, 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('blog', 'ID'),
            'text' => Yii::t('blog', 'Text'),
            'user_id' => Yii::t('blog', 'User ID'),
            'article_id' => Yii::t('blog', 'Article ID'),
            'status' => Yii::t('blog', 'Status'),
            'created_at' => Yii::t('blog', 'Created At'),
            'updated_at' => Yii::t('blog', 'Updated At'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::class, ['id' => 'article_id']);
    }
}
