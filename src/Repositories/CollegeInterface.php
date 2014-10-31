<?php

namespace CollegeFB\Repositories;

use CollegeFB\Entities\College as CollegeEntity;

interface CollegeInterface
{
    public function save(CollegeEntity $college);

    public function remove(CollegeEntity $college);

    public function getByName($college_name);

    public function getById($college_id);

    public function getByUrl($college_url);

    public function listAll($page, $limit);
}
