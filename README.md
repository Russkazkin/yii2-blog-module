# yii2-blog-module
Yii2 Blog module

#Install

* Add this to web.php 'modules' section:

        'auth' => [
            'class' => 'app\modules\blog\Module'
        ],
* Add this to console.php 'modules' section:

        'auth' => [
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
            'fileMap' => [
                'blog' => '/modules/blog/messages'
            ]
        ],
       
