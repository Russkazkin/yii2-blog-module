<?php

namespace app\modules\blog\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `blog_category`.
 */
class m191001_145218_create_category_table extends Migration
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
        $this->createTable('blog_category', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-category_id',
            'blog_article',
            'category_id',
            'blog_category',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_category');
    }
}
