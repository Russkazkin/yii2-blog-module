<?php


namespace app\modules\blog\models;


use app\modules\auth\models\User;
use app\modules\blog\models\base\BaseArticle;
use DateTime;
use Yii;
use yii\behaviors\TimestampBehavior;

class Article extends BaseArticle
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
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['title', 'description', 'content', 'date'], 'required'],
            [['description', 'content', 'title'], 'string'],
            [['date'], 'safe'],
            [['viewed', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    public function beforeValidate()
    {
        $format = substr(Yii::$app->formatter->dateFormat, 4, 5);
        $date = DateTime::createFromFormat($format, $this->date);
        if($date){
            $this->date = $date->format('Y-m-d');
        }
        return parent::beforeValidate();
    }
}