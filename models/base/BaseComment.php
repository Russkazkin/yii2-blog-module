<?php

namespace app\modules\blog\models\base;

use Yii;

/**
 * This is the model class for table "blog_comment".
 *
 * @property int $id
 * @property string $text
 * @property int|null $user_id
 * @property int|null $parent_id
 * @property int $article_id
 * @property int $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property BlogArticle $article
 * @property AuthUser $user
 */
class BaseComment extends \yii\db\ActiveRecord
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
            [['text', 'article_id'], 'required'],
            [['text'], 'string'],
            [['user_id', 'parent_id', 'article_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuthUser::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'parent_id' => Yii::t('blog', 'Parent ID'),
            'article_id' => Yii::t('blog', 'Article ID'),
            'status' => Yii::t('blog', 'Status'),
            'created_at' => Yii::t('blog', 'Created At'),
            'updated_at' => Yii::t('blog', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(BlogArticle::className(), ['id' => 'article_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(AuthUser::className(), ['id' => 'user_id']);
    }
}
