<?php

namespace app\modules\blog\migrations;

use yii\db\Migration;

/**
 * Class m191101_144836_insert_tags
 */
class m191101_144836_insert_tags extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('blog_tag', [
            'title' => 'News',
            'created_at' => strtotime('now'),
            'updated_at' => strtotime('now'),
        ]);

        $this->insert('blog_tag', [
            'title' => 'Linux',
            'created_at' => strtotime('now'),
            'updated_at' => strtotime('now'),
        ]);

        $this->insert('blog_tag', [
            'title' => 'PHP',
            'created_at' => strtotime('now'),
            'updated_at' => strtotime('now'),
        ]);

        $this->insert('blog_tag', [
            'title' => 'Docker',
            'created_at' => strtotime('now'),
            'updated_at' => strtotime('now'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('blog_tag');
    }
}
