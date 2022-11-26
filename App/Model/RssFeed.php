<?php

namespace App\Model;

/**
 * Model for rss_feed table
 */
class RssFeed
{
    /**
     * @param array $data
     * @return void
     */
    public static function insert(array $data) {
        $db = Migration::db();
        $tableAlias = $db->dbName.'.rss_feed';

        $db->run("
            INSERT INTO $tableAlias (
                title,
                description,
                link,
                last_build_date,
                copyright,
                items
                                ) 
                VALUES (?, ?, ?, ?, ?, ?)
            ",$data);

    }

    /**
     * @return void
     */
    public static function truncate() {
        $db = Migration::db();
        $tableAlias = $db->dbName.'.rss_feed';
        $db->run("DELETE FROM $tableAlias");
    }
}