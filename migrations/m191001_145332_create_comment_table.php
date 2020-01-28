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
            'entity' => $this->char(10)->notNull(),
            'entityId' => $this->integer()->notNull(),
            'content' => $this->text()->notNull(),
            'parentId' => $this->integer()->null(),
            'level' => $this->smallInteger()->notNull()->defaultValue(1),
            'createdBy' => $this->integer()->notNull(),
            'updatedBy' => $this->integer()->notNull(),
            'relatedTo' => $this->string(500)->notNull(),
            'url' => $this->text(),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'createdAt' => $this->integer()->notNull(),
            'updatedAt' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-Comment-entity', 'blog_comment', 'entity');
        $this->createIndex('idx-Comment-status', 'blog_comment', 'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_comment');
    }
}
