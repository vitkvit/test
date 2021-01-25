<?php

use yii\db\Migration;

class m210124_121507_task extends Migration
{
    public function up()
    {
        if (!$this->isTableExists('task')) {
            $this->execute('
                CREATE TABLE `task` (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    `name` VARCHAR(255) NOT NULL,
                    `content` TEXT NOT NULL,
                    `closed` TINYINT NOT NULL DEFAULT 0,
                    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    PRIMARY KEY (`id`),
                    INDEX idx_created_at (created_at)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci
            ');
        }

        return true;
    }

    public function down()
    {
        if ($this->isTableExists('task')) {
            $this->execute('DROP TABLE `task`');
        }
        return true;
    }

    public function isTableExists($tableName)
    {
        return $this->getDb()->getSchema()->getTableSchema($tableName) !== null;
    }
}
