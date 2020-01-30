# yii2-blog-module
Yii2 Blog module

#Install

* Add this to web.php 'modules' section:

        'blog' => [
             'class' => 'app\modules\blog\Module',
             'components' => [
                 'article' => ArticleComponent::class,
                 'category' => CategoryComponent::class,
             ]
         ],
* Add this to console.php 'modules' section:

        'blog' => [
            'class' => 'app\modules\blog\Module'
        ],
* Add this to console.php 'controllerMap' section:

        'migrate-blog' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => ['app\modules\blog\migrations'],
            'migrationTable' => 'migration_blog'
        ],
        
* Add this to web.php ''i18n' => ['translations'] section:
        
        'blog*' => [
            'class' => PhpMessageSource::class,
            'basePath' => '@app/modules/blog/messages',
            'fileMap' => [
                'blog' => 'blog.php'
            ]
        ],
        
Require [Yii2 Comments Extension](https://github.com/yii2mod/yii2-comments) module for article comments. User this 
module installation instructions
       
