<?php

namespace CollegeFB\Repositories\MongoDB;

use CollegeFB\Repositories\ConferenceInterface;
use CollegeFB\Entities\Conference as ConferenceEntity;
use CollegeFB\Iterators\Conference as ConferenceIterator;
use MongoDB;
use MongoId;
use MongoDate;

class Conference implements ConferenceInterface
{
    const COLLECTION_NAME = 'conferences';

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

    public function save(ConferenceEntity $conference)
    {
        $conference_info = $conference->getData();

        if ((false !== $conference->hasId()) && (null !== ($id = $conference->getId()))) {
            $conference_info['_id'] = new MongoId($id);
        } else {
            $conference_info['_id'] = new MongoId();
            $conference->setId($conference_info['_id']);
        }

        $conference_info['updated'] = new MongoDate();
        $this->collection->save($conference_info);

        return $conference;
    }

    public function remove(ConferenceEntity $conference)
    {
        $id = $conference->getId();

        return (!empty($id)) ? $this->collection->remove(array('_id' => new MongoId($id))) : null;
    }

    public function getById($conference_id)
    {
        return new ConferenceEntity($this->collection->findOne(array('_id' => new MongoId($conference_id))));
    }

    public function getByName($conference_name)
    {
        $conference_info = $this->collection->findOne(array('name' => (string) $conference_name));

        return (!empty($conference_info)) ? new ConferenceEntity($conference_info) : false;
    }

    public function getByUrl($conference_url)
    {
        $conference_info = $this->collection->findOne(array('url' => (string) $conference_url));

        return (!empty($conference_info)) ? new ConferenceEntity($conference_info) : false;
    }

    public function listAll($page, $limit)
    {
        $conferences = $this->collection
                            ->find($this->query_params)
                            ->sort(array('name' => 1))
                            ->skip((int) $page * (int) $limit)
                            ->limit((int) $limit);

        $conference_iterator = new ConferenceIterator();

        $conference_iterator->addConferences(iterator_to_array($conferences));

        return $conference_iterator;
    }
}
