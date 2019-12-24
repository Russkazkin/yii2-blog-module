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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('blog_article', [
            'id' => $this->primaryKey(),
            'title' => $this->string(36)->notNull(),
            'description' => $this->string(128)->notNull(),
            'content' => $this->text()->notNull(),
            'date' => $this->integer(11),
            'image' => $this->string(),
            'viewed' => $this->integer(),
            'user_id' => $this->integer(),
            'category_id'=>$this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $tableOptions);

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
