<?php

namespace CollegeFB\Iterators;

use CollegeFB\Entities\Conference as ConferenceEntity;
use ArrayIterator;

class Conference extends ArrayIterator
{
    public function append($value)
    {
        if (!empty($value['_id'])) {
            $value['id'] = (string) $value['_id'];
            unset($value['_id']);
        }

        parent::append(new ConferenceEntity($value));
    }

    public function addConferences(array $conference_list)
    {
        foreach ($conference_list as $conference) {
            $this->append($conference);
        }
    }
}
