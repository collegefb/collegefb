<?php

namespace CollegeFB\Iterators;

use CollegeFB\Entities\College as CollegeEntity;
use ArrayIterator;

class College extends ArrayIterator
{
    public function append($value)
    {
        if (!empty($value['_id'])) {
            $value['id'] = (string) $value['_id'];
            unset($value['_id']);
        }

        parent::append(new CollegeEntity($value));
    }

    public function addColleges(array $college_list)
    {
        foreach ($college_list as $college) {
            $this->append($college);
        }
    }
}
