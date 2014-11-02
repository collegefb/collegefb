<?php

namespace CollegeFB\Services\Conference;

use CollegeFB\Services\ConferenceAbstract;

class OneConference extends ConferenceAbstract
{
    public function run(array $options)
    {
        $conference_data = null;

        if (!empty($options['conference_id'])) {

            $conference_data = $this->getById($options['conference_id']);

        } elseif (!empty($options['conference_url'])) {

            $conference_data = $this->getByUrl($options['conference_url']);

        }

        return $conference_data;
    }

    private function getById($conference_id)
    {
        return $this->repository->getById($conference_id);
    }

    private function getByUrl($conference_url)
    {
        return $this->repository->getByUrl($conference_url);
    }
}
