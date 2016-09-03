<?php

use yii\db\Migration;

/**
 * Handles the creation for table `contact`.
 */
class m160903_081952_create_contact_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('contact', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string(255)->notNull(),
            'create_date' => $this->integer(11)->notNull()->unsigned(),
            'creator_ip' => $this->integer()->notNull()->unsigned(),
        ]);

        $this->insert('contact', [
            'name' => 'Путин Владимир Владимирович',
            'create_date' => microtime(true),
            'creator_ip' => ip2long('192.168.0.1'),
        ]);
        $this->insert('contact', [
            'name' => 'Медведев Дмитрий Анатольевич',
            'create_date' => microtime(true),
            'creator_ip' => ip2long('192.168.0.1'),
        ]);
        $this->insert('contact', [
            'name' => 'Шойгу Сергей Кужугетович',
            'create_date' => microtime(true),
            'creator_ip' => ip2long('192.168.0.1'),
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('contact');
    }
}
