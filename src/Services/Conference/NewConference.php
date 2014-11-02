<?php

namespace CollegeFB\Services\Conference;

use CollegeFB\Services\ConferenceAbstract;

class NewConference extends ConferenceAbstract
{
    public function run(array $options)
    {
        if (isset($options['_id'])) {
            unset($options['_id']);
        }

        $conference = $this->factory->conferenceEntity($options);
        if (false !== $this->conferenceExists($conference->getName())) {
            throw new \RuntimeException('Conference already exists in database');
        }

        return $this->repository->save($conference);
    }

    private function conferenceExists($conference_name)
    {
        return (false !== $this->repository->getByName($conference_name));
    }
}
