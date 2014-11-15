<?php

namespace CollegeFB\Repositories\MongoDB;

use CollegeFB\Repositories\NewsInterface;
use CollegeFB\Entities\News as NewsEntity;
use CollegeFB\Iterators\News as NewsIterator;
use MongoDB;
use MongoId;
use MongoDate;

class News implements NewsInterface
{
    const COLLECTION_NAME = 'news';

    private $collection;
    private $query_params = array();

    public function __construct(MongoDB $connection)
    {
        $this->collection = $connection->selectCollection(self::COLLECTION_NAME);
    }

    public function setQueryParams($param, $value)
    {
        if (!empty($value)) {
            $this->query_params[$param] = (string) $value;
        }
    }

    public function save(NewsEntity $news)
    {
        $news_info = $news->getData();

        if ((false !== $news->hasId()) && (null !== ($id = $news->getId()))) {
            $news_info['_id'] = new MongoId($id);
        } else {
            $news_info['_id'] = new MongoId();
            $news->setId($news_info['_id']);
        }

        $news_info['pub_date'] = new MongoDate($news_info['pub_date']);

        $this->collection->save($news_info);

        return $news;
    }

    public function remove(NewsEntity $news)
    {
        $id = $news->getId();

        return (!empty($id)) ? $this->collection->remove(array('_id' => new MongoId($id))) : null;
    }

    public function clear()
    {
        $this->collection->drop();
    }

    public function listAll($page, $limit)
    {
        $news = $this->collection
                        ->find($this->query_params)
                        ->sort(array('pub_date' => -1))
                        ->skip((int) $page * (int) $limit)
                        ->limit((int) $limit);

        $news_iterator = new NewsIterator();

        $news_iterator->addNews(iterator_to_array($news));

        return $news_iterator;
    }

    public function getByLink($news_link)
    {
        $news = $this->collection->findOne(array('link' => (string) $news_link));

        return (!empty($news)) ? new NewsEntity($news) : false;
    }

    public function getById($news_id)
    {
        $news = $this->collection->findOne(array('_id' => new MongoId($news_id)));

        return (!empty($news)) ? new NewsEntity($news) : false;
    }
}
