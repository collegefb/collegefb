<?php

namespace CollegeFB\Repositories;

use CollegeFB\Entities\Conference as ConferenceEntity;

interface ConferenceInterface
{
    public function save(ConferenceEntity $conference);

    public function remove(ConferenceEntity $conference);

    public function setQueryParams($param, $value);

    public function listAll($page, $limit);

    public function getById($conference_id);

    public function getByName($conference_name);

    public function getByUrl($conference_url);
}
