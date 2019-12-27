<?php

namespace app\modules\blog\models\base;

use app\modules\auth\models\User;
use app\modules\blog\models\Category;
use Yii;

/**
 * This is the model class for table "blog_article".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property int $date
 * @property string $image
 * @property int $viewed
 * @property int $user_id
 * @property int $category_id
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BlogCategory $category
 * @property AuthUser $user
 * @property BlogArticleTag[] $blogArticleTags
 * @property BlogComment[] $blogComments
 */
class BaseArticle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'blog_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['date', 'viewed', 'user_id', 'category_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 128],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('blog', 'ID'),
            'title' => Yii::t('blog', 'Title'),
            'description' => Yii::t('blog', 'Description'),
            'content' => Yii::t('blog', 'Content'),
            'date' => Yii::t('blog', 'Date'),
            'image' => Yii::t('blog', 'Image'),
            'viewed' => Yii::t('blog', 'Viewed'),
            'user_id' => Yii::t('blog', 'User ID'),
            'category_id' => Yii::t('blog', 'Category ID'),
            'status' => Yii::t('blog', 'Status'),
            'created_at' => Yii::t('blog', 'Created At'),
            'updated_at' => Yii::t('blog', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::class, ['article_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogComments()
    {
        return $this->hasMany(Comment::className(), ['article_id' => 'id']);
    }
}
