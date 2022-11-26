<?php


namespace App\Model;


class Migration
{
    const RSS_FEED_TABLE_NAME = 'rss_feed';
    /**
     * @return DB
     */
    public static function db():DB {
        $config = include __DIR__. '/../config.php';
        return new DB(
            $config['db_name'],
            $config['username'],
            $config['password'],
            $config['host'],
            $config['port']
        );
    }

    /**
     * @return void
     */
    public static function migrate(){
        $config = include __DIR__. '/../config.php';
        self::newDB(self::db(),  $config['db_name']);
        self::createRssFeedTable(self::db(),  $config['db_name']);

    }

    /**
     * @param DB $db
     * @param $dbName
     */
    private static function newDB(DB $db, $dbName){
        $sql = "CREATE DATABASE IF NOT EXISTS `$dbName`";
        $db->pdo->exec($sql);
    }

    /**
     * @param DB $db
     * @param $dbName
     */
    private static function createRssFeedTable(DB $db, $dbName){
        $schema = "
        CREATE TABLE IF NOT EXISTS  `$dbName`.`rss_feed` (
                    `id` INT NOT NULL AUTO_INCREMENT,
                    `title` VARCHAR(255),
                    `description` VARCHAR(255),
                    `link` VARCHAR(255),
                    `last_build_date` DATETIME,
                    `copyright` VARCHAR(255),
                    `items` JSON,
                    PRIMARY KEY (`id`));
        ";

        $db->run($schema);
    }
}