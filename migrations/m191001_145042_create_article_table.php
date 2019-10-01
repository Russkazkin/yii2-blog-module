<?php

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
            'date' => $this->date()->notNull(),
            'image' => $this->string()->defaultValue('https://via.placeholder.com/300x200.jpg?text=Yii2+Blog+Module+Placeholder'),
            'viewed' => $this->integer(),
            'user_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
    }
}
