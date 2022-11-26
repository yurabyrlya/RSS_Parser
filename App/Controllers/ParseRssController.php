<?php

namespace  App\Controllers;

use App\Helpers\Response;
use App\Model\Migration;
use App\Model\RssFeed;
use App\Services\RssFeedParser;


class ParseRssController implements ControllerInterface
{

    /**
     * @return Response
     */
    public function index()
    {
        return Response::view('index', [
            'title'=> 'RSS tool',
            'message' => 'RSS tool',
            'data' => []
        ]);
    }

    /**
     * @return Response
     */
    public function rss()
    {
        $rssFeed = new RssFeedParser();
        $rootXmlObject = $rssFeed->parse('https://lorem-rss.herokuapp.com/feed');

        if (!isset($rootXmlObject->channel)) {
            throw new \ParseError('root channel tag  required');
        }

        $xmlObject = $rootXmlObject->channel;

        RssFeed::truncate();
        foreach ($xmlObject->item as $item) {
            RssFeed::insert( [
                $title = filter_var((string) $item->title, FILTER_SANITIZE_STRING),
                $description = filter_var((string) $item->description, FILTER_SANITIZE_STRING),
                $link = filter_var((string) $item->link, FILTER_SANITIZE_URL),
                $updated_at = date('Y-m-d H:i:s'),
                $copyright = 'Iuri Birlea',
                $items =  json_encode(['test'=> 'value']),
            ]);
        }

        $db = Migration::db();
        $tableAlias = $db->dbName.'.rss_feed';
        $data = $db->run("SELECT * FROM $tableAlias LIMIT 100")->fetchAll();

        return Response::view('rss_feed', [
            'title'=> 'RSS feed',
            'message' => 'RSS feed page',
            'data' => $data
        ]);
    }
}