<?php

namespace CollegeFB\Services\Conference;

use CollegeFB\Services\ConferenceAbstract;

class RemoveConference extends ConferenceAbstract
{
    public function run(array $options)
    {
        if (false === ($conference = $this->conferenceExists($options['conference_id']))) {
            throw new \RuntimeException('Conference not found in database');
        }

        return $this->repository->remove($conference);
    }

    private function conferenceExists($conference_id)
    {
        return $this->repository->getById($conference_id);
    }
}
