<?php


namespace app\modules\blog\models;


use app\modules\blog\models\base\BaseCategory;
use app\modules\blog\Module;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

class Category extends BaseCategory
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

    public function getArticlesCount()
    {
        return $this->hasMany(Article::class, ['category_id' => 'id'])->count();
    }

    public static function navigation()
    {
        $categories = Category::find()->where(['status' => Category::STATUS_ACTIVE])->all();
        $data = array_filter($categories, function($category){
            return $category->getArticles()->count();
        });
        return ArrayHelper::map($data, 'id', 'title');
    }

}