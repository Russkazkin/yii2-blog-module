<?php


namespace app\modules\blog\models;


use app\modules\auth\models\User;
use app\modules\blog\models\base\BaseArticle;
use DateTime;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/* @property UploadedFile $file */
class Article extends BaseArticle
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const SCENARIO_UPLOAD = 'upload';
    const SCENARIO_SAVE = 'save';

    public $format;
    public $phpFormat;
    public $file;

    public function scenarioUpload(): self
    {
        $this->setScenario(self::SCENARIO_UPLOAD);
        return $this;
    }

    public function scenarioSave(): self
    {
        $this->setScenario(self::SCENARIO_SAVE);
        return $this;
    }

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
     * @return bool
     * @throws \yii\base\Exception
     */
    public function upload()
    {
        if (true) { //TODO: add image validation!
            FileHelper::createDirectory('uploads/');
            $this->file->saveAs(Yii::getAlias('@uploads') . $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }

    public function saveImage($name)
    {
    }
}