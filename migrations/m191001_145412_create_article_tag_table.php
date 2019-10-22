<?php

namespace app\modules\blog\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `blog_article_tag`.
 */
class m191001_145412_create_article_tag_table extends Migration
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
        $this->createTable('blog_article_tag', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'tag_id'  => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex(
            'tag_article_article_id',
            'blog_article_tag',
            'article_id'
        );

        $this->addForeignKey(
            'tag_article_article_id',
            'blog_article_tag',
            'article_id',
            'blog_article',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx_tag_id',
            'blog_article_tag',
            'tag_id'
        );

        $this->addForeignKey(
            'fk-tag_id',
            'blog_article_tag',
            'tag_id',
            'blog_tag',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_article_tag');
    }
}
