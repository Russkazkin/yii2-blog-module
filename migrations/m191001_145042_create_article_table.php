<?php

namespace app\modules\blog\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `blog_article`.
 */
class m191001_145042_create_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blog_article', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
            'date' => $this->integer(11),
            'image' => $this->string()->defaultValue('https://via.placeholder.com/300x200.jpg?text=Yii2+Blog+Module+Placeholder'),
            'viewed' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);

        $this->addForeignKey(
            'fk-user_id',
            'blog_article',
            'user_id',
            'auth_user',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_article');
    }
}
