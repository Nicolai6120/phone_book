<?php

use yii\db\Migration;

/**
 * Handles the creation for table `phone`.
 */
class m160903_090103_create_phone_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('phone', [
            'id' => $this->primaryKey()->unsigned(),
            'number' => $this->string(32)->notNull(),
            'contact_id' => $this->integer(11)->notNull()->unsigned(),
            'create_date' => $this->integer(11)->notNull()->unsigned(),
            'creator_ip' => $this->integer()->notNull()->unsigned(),
        ]);

        $this->insert('phone', [
            'number' => '+7 (000) 000 00-01',
            'contact_id' => 1,
            'create_date' => microtime(true) - 6000,
            'creator_ip' => ip2long('192.168.0.1'),
        ]);
        $this->insert('phone', [
            'number' => '+7 (495) 000 20-40',
            'contact_id' => 1,
            'create_date' => microtime(true) - 3000,
            'creator_ip' => ip2long('192.168.0.1'),
        ]);
        $this->insert('phone', [
            'number' => '+7 (700) 000 60-40',
            'contact_id' => 1,
            'create_date' => microtime(true),
            'creator_ip' => ip2long('192.168.0.1'),
        ]);

        $this->insert('phone', [
            'number' => '+7 (495) 000 00-17',
            'contact_id' => 2,
            'create_date' => microtime(true) - 6000,
            'creator_ip' => ip2long('192.168.0.1'),
        ]);
        $this->insert('phone', [
            'number' => '+7 (495) 000 20-17',
            'contact_id' => 2,
            'create_date' => microtime(true) - 3000,
            'creator_ip' => ip2long('192.168.0.1'),
        ]);

        $this->insert('phone', [
            'number' => '+7 (700) 000 60-17',
            'contact_id' => 3,
            'create_date' => microtime(true),
            'creator_ip' => ip2long('192.168.0.1'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('phone');
    }
}
