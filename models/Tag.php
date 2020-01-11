<?php


namespace app\modules\blog\models;


use app\modules\blog\models\base\BaseTag;
use app\modules\blog\Module;
use yii\behaviors\TimestampBehavior;

class Tag extends BaseTag
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
        return array_merge(parent::rules(), [
            [['title'], 'string', 'max' => 32],
            [['title'], 'unique'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('blog', 'ID'),
            'title' => Module::t('blog', 'Title'),
            'status' => Module::t('blog', 'Status'),
            'created_at' => Module::t('blog', 'Created At'),
            'updated_at' => Module::t('blog', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getArticles()
    {
        return $this->hasMany(Article::class, ['id' => 'article_id'])
            ->viaTable('blog_article_tag', ['tag_id' => 'id']);
    }
}