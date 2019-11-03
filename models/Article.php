<?php


namespace app\modules\blog\models;


use app\modules\auth\models\User;
use app\modules\blog\models\base\BaseArticle;
use app\modules\blog\Module;
use DateTime;
use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\validators\NumberValidator;
use yii\web\UploadedFile;

/**
 * @property UploadedFile $file
 * @property Category $category
 * @property User $user
 * @property ArticleTag[] $articleTags
 * @property Comment[] $comments
 * @property Category[] $categoriesList
 * @property ArticleTag[] $tags
 * @property ArticleTag[] $selectedTags
 * @property ArticleTag[] $tagsList
 */


class Article extends BaseArticle
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $format;
    public $phpFormat;
    public $file;
    public $tags;

    public function init()
    {
        parent::init();

        $this->format = Yii::$app->language == 'en-US' ? 'mm-dd-yyyy' : 'dd-mm-yyyy';
        $this->phpFormat = substr(Yii::$app->formatter->dateFormat, 4, 5);
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['title', 'description', 'content', 'date'], 'required'],
            [['description', 'content', 'title'], 'string'],
            [['viewed', 'user_id', 'status', 'created_at', 'updated_at'], 'safe'],
            [['viewed', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'checkExtensionByMimeType' => false],
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('blog', 'ID'),
            'title' => Module::t('blog', 'Title'),
            'description' => Module::t('blog', 'Description'),
            'content' => Module::t('blog', 'Content'),
            'date' => Module::t('blog', 'Date'),
            'image' => Module::t('blog', 'Image'),
            'viewed' => Module::t('blog', 'Viewed'),
            'user_id' => Module::t('blog', 'User ID'),
            'category_id' => Module::t('blog', 'Category ID'),
            'status' => Module::t('blog', 'Status'),
            'created_at' => Module::t('blog', 'Created At'),
            'updated_at' => Module::t('blog', 'Updated At'),
        ];
    }

    public function beforeValidate()
    {

        $date = DateTime::createFromFormat($this->phpFormat, $this->date);

        if ($date) {
            $this->date = $date->getTimestamp();
        }

        return parent::beforeValidate();
    }

    /**
     * @param null $currentImage
     * @return bool
     * @throws \yii\base\Exception
     */
    public function upload($currentImage = null)
    {
        if ($this->validate()) {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
        return null;
    }

    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->file->baseName))) . '.' . $this->file->extension;
    }

    private function deleteCurrentImage($currentImage)
    {
        if (!empty($currentImage) && $this->fileExists($currentImage)) {
            unlink(Yii::getAlias('@blog_uploads') . $currentImage);
        }
    }

    public function fileExists($file)
    {
        return file_exists(Yii::getAlias('@blog_uploads') . $file);
    }

    private function saveImage()
    {
        FileHelper::createDirectory(Yii::getAlias('@blog_uploads'));
        $filename = $this->generateFilename();
        $this->file->saveAs(Yii::getAlias('@blog_uploads') . $filename);
        return $filename;
    }

    public function getImage()
    {
        return $this->image ? '/blog_uploads/' . $this->image : 'https://via.placeholder.com/300x200.png?text=' .
            $this->title;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getCategoriesList()
    {
        return ArrayHelper::map(Category::find()->all(), 'id', 'title');
    }

    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('blog_article_tag', ['article_id' => 'id']);
    }

    public function getTagsList() {
        return ArrayHelper::map(Tag::find()->all(), 'id', 'title');
    }

    public function getSelectedTags()
    {
        $selectedTags = $this->getTags()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedTags, 'id');
    }

    /**
     * Tags for Article index and view
     * @return string
     */
    public function getSelectedTagsTitle()
    {
        $selectedTags = $this->getTags()->select('title')->asArray()->all();
        return implode(', ', ArrayHelper::getColumn($selectedTags, 'title'));
    }

    public function saveTags()
    {
        $validator = new NumberValidator();
        ArticleTag::deleteAll(['article_id' => $this->id]);

        $tags = Yii::$app->request->post('tags');
        if(is_array($tags)){
            foreach ($tags as $tag_id){
                if($validator->validate($tag_id, $error)) {
                    $tag = Tag::findOne((int)$tag_id);
                    $this->link('tags', $tag);
                }else{
                    die($error); //TODO Add user friendly error
                }
            }
        }
    }
}