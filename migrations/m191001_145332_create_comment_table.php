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
            'user_id' => $this->integer()->notNull(),
            'article_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_comment');
    }
}
