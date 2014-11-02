<?php

namespace CollegeFB\Factories;

use CollegeFB\Entities\Conference as ConferenceEntity;
use CollegeFB\Iterators\Conference as ConferenceIterator;
use CollegeFB\Repositories\MongoDB\Conference as ConferenceRepositoryMongoDB;
use CollegeFB\Repositories\ConferenceInterface;
use CollegeFB\Services\Conference\NewConference as NewConferenceService;
use CollegeFB\Services\Conference\UpdateConference as UpdateConferenceService;
use CollegeFB\Services\Conference\ListConferences as ListConferencesService;
use CollegeFB\Services\Conference\OneConference as OneConferenceService;
use CollegeFB\Services\Conference\RemoveConference as RemoveConferenceService;
use MongoDB;

class Conference
{
    public function conferenceEntity(array $conference_info = array())
    {
        return new ConferenceEntity($conference_info);
    }

    public function conferenceRepository($database)
    {
        if ($database instanceof MongoDB) {
            return new ConferenceRepositoryMongoDB($database);
        }

        return null;
    }

    public function conferenceIterator(array $conferences)
    {
        return new ConferenceIterator($conferences);
    }

    public function newConferenceService(ConferenceInterface $repository)
    {
        return new NewConferenceService($repository, $this);
    }

    public function updateConferenceService(ConferenceInterface $repository)
    {
        return new UpdateConferenceService($repository, $this);
    }

    public function listConferencesService(ConferenceInterface $repository)
    {
        return new ListConferencesService($repository, $this);
    }

    public function oneConferenceService(ConferenceInterface $repository)
    {
        return new OneConferenceService($repository, $this);
    }

    public function removeConferenceService(ConferenceInterface $repository)
    {
        return new RemoveConferenceService($repository, $this);
    }
}
