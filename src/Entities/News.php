<?php

namespace CollegeFB\Entities;

class News extends EntityAbstract
{
    protected $data = array(
        '_id'           => null,
        'title'         => null,
        'link'          => null,
        'description'   => null,
        'author'        => null,
        'pub_date'      => null,
        'origin'        => null,
        'origin_id'     => null,
    );

    public function __construct($news = null)
    {
        if (!empty($news) && is_array($news)) {

            foreach ($news as $key => $value) {
                $method = 'set' . $this->toCamelCase($key);
                call_user_func(array($this, $method), $value);
            }

        }
    }
}
