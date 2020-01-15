<?php

namespace app\modules\blog\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `blog_comment`.
 */
class m191001_145332_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('blog_comment', [
            'id' => $this->primaryKey(),
            'text' => $this->text()->notNull(),
            'user_id' => $this->integer(),
            'parent_id' => $this->integer(),
            'article_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $tableOptions);

        $this->createIndex(
            'idx-article_id',
            'blog_comment',
            'article_id'
        );

        $this->addForeignKey(
            'fk-article_id',
            'blog_comment',
            'article_id',
            'blog_article',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-user_id-comment',
            'blog_comment',
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
        $this->dropTable('blog_comment');
    }
}
