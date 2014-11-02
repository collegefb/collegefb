<?php

namespace CollegeFB\Services\Conference;

use CollegeFB\Services\ConferenceAbstract;

class UpdateConference extends ConferenceAbstract
{
    public function run(array $options)
    {
        $conference = $this->factory->conferenceEntity($options);

        if ((false === $conference->hasId()) || (false === $this->conferenceExists($conference->getId()))) {
            throw new \RuntimeException('Conference not found in database');
        }

        return $this->repository->save($conference);
    }

    private function conferenceExists($conference_id)
    {
        return (false !== $this->repository->getById($conference_id));
    }
}
