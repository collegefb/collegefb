<?php

namespace CollegeFB\Repositories\MongoDB;

use CollegeFB\Repositories\CollegeInterface;
use CollegeFB\Entities\College as CollegeEntity;
use CollegeFB\Iterators\College as CollegeIterator;
use MongoDB;
use MongoId;

class College implements CollegeInterface
{
    const COLLECTION_NAME = 'colleges';

    private $collection;
    private $query_params = array();

    public function __construct(MongoDB $connection)
    {
        $this->collection = $connection->selectCollection(self::COLLECTION_NAME);
    }

    public function setQueryParams($param, $value)
    {
        if (!empty($value)) {
            $this->query_params[$param] = $value;
        }
    }

    public function save(CollegeEntity $college)
    {
        $college_info = $college->getData();

        if ((false !== $college->hasId()) && (null !== ($id = $college->getId()))) {
            $college_info['_id'] = new MongoId($id);
        } else {
            $college_info['_id'] = new MongoId();
            $college->setId($college_info['_id']);
        }

        $this->collection->save($college_info);

        return $college;
    }

    public function remove(CollegeEntity $college)
    {
        $id = $college->getId();

        return (!empty($id)) ? $this->collection->remove(array('_id' => $id)) : null;
    }

    public function getByName($college_name)
    {
        $college_info = $this->collection->findOne(array('name' => $college_name));

        return (!empty($college_info)) ? new CollegeEntity($college_info) : false;
    }

    public function getById($college_id)
    {
        $id = new MongoId($college_id);

        $college_info = $this->collection->findOne(array('_id' => $id));

        return (!empty($college_info)) ? new CollegeEntity($college_info) : false;
    }

    public function getByUrl($college_url)
    {
        $college_info = $this->collection->findOne(array('url' => $college_url));

        return (!empty($college_info)) ? new CollegeEntity($college_info) : false;
    }

    public function listAll($page, $limit)
    {
        $colleges = $this->collection->find($this->query_params)->sort(array('name' => 1))->skip($page * $limit)->limit($limit);

        $college_iterator = new CollegeIterator();

        $college_iterator->addColleges(iterator_to_array($colleges));

        return $college_iterator;
    }
}
