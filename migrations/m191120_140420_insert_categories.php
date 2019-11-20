<?php

namespace app\modules\blog\migrations;

use yii\db\Migration;

/**
 * Class m191120_140420_insert_categories
 */
class m191120_140420_insert_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('blog_category',['title', 'created_at', 'updated_at'],[
            ['Linux', strtotime('now'), strtotime('now')],
            ['Web', strtotime('now'), strtotime('now')],
            ['Yii2', strtotime('now'), strtotime('now')],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('blog_category');
    }
}
