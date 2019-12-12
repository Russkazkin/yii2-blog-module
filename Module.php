<?php

namespace app\modules\blog;

use Yii;

/**
 * blog module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    //public $layout = '@app/modules/admin/views/layouts/admin.php';
    public $controllerNamespace = 'app\modules\blog\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
        Yii::setAlias('@blog_uploads', '@webroot/blog_uploads/');
        Yii::$app->errorHandler->errorAction = 'blog/blog/error';

        // custom initialization code goes here
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['blog'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'en-US',
            'basePath' => '@app/modules/blog/messages',
            'fileMap' => [
                'blog' => 'blog.php',
            ],
        ];
    }

    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t($category, $message, $params, $language);
    }
}
