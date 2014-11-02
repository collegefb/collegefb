<?php

namespace CollegeFB\Services\Conference;

use CollegeFB\Services\ConferenceAbstract;

class ListConferences extends ConferenceAbstract
{
    const LIMIT = 25;

    public function run(array $options)
    {
        $page = !empty($options['page']) ? $options['page'] : 0;
        $limit = !empty($options['limit']) ? $options['limit'] : self::LIMIT;
        $division = !empty($options['division']) ? $options['division'] : null;

        $division = $this->getDivision($division);

        if (!is_null($division) && 'NAIA' !== $division) {

            $this->repository->setQueryParams('organization', 'NCAA');
            $this->repository->setQueryParams('division', $division);

        } elseif (!is_null($division) && 'NAIA' === $division) {

            $this->repository->setQueryParams('organization', $division);

        }

        return $this->repository->listAll($page, $limit);
    }

    private function getDivision($division)
    {
        switch ($division) {
            case 'fbs':
                $division = 'Division I FBS';
                break;

            case 'fcs':
                $division = 'Division I FCS';
                break;

            case 'd2':
                $division = 'Division II';
                break;

            case 'd3':
                $division = 'Division III';
                break;

            case 'naia':
                $division = 'NAIA';
                break;

            default:
                $division = null;
                break;
        }

        return $division;
    }
}
