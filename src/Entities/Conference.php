<?php

namespace CollegeFB\Entities;

class Conference extends EntityAbstract
{
    protected $data = array(
        '_id'           => null,
        'name'          => null,
        'nickname'      => null,
        'established'   => null,
        'division'      => null,
        'logo'          => null,
        'headquarters'  => null,
        'commissioner'  => null,
        'website'       => null,
        'facebook'      => null,
        'twitter'       => null,
        'url'           => null,
        'rss'           => null,
        'football_url'  => null,
        'rss_football'  => null,
        'twitter_football'  => null,
        'facebook_football' => null,
        'organization'      => null,
        'updated'       => null,
    );

    public function __construct($conference = null)
    {
        if (!empty($conference) && is_string($conference)) {

            $this->setName($conference);

        } elseif (is_array($conference)) {

            foreach ($conference as $key => $value) {
                $method = 'set' . $this->toCamelCase($key);
                call_user_func(array($this, $method), $value);
            }

        }
    }

    public function setUrl($url)
    {
        return $this;
    }

    public function setName($conference_name)
    {
        $this->data['name'] = $conference_name;

        $this->data['url'] = $this->generateUrl();

        return $this;
    }

    private function generateUrl()
    {
        $clean_name = preg_replace('@[^a-zA-Z0-9\s-_]@', '', strtolower(trim($this->data['name'])));

        return trim(str_replace(array(' ', '_'), '-', $clean_name), '-');
    }
}
