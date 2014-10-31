<?php

namespace CollegeFB\Entities;

class College extends EntityAbstract
{
    protected $data = array(
        '_id'                 => null,
        'athletic_director'   => null,
        'city'                => null,
        'colors'              => null,
        'conference'          => null,
        'conference_division' => null,
        'division'            => null,
        'facebook'            => null,
        'fbs_since'           => null,
        'first_played'        => null,
        'first_season'        => null,
        'football'            => null,
        'football_rss'        => null,
        'head_coach'          => null,
        'home_stadium'        => null,
        'location'            => null,
        'logo'                => null,
        'name'                => null,
        'nickname'            => null,
        'organization'        => null,
        'rivals'              => array(),
        'rss'                 => null,
        'stadium_capacity'    => null,
        'stadium_surface'     => null,
        'state'               => null,
        'twitter'             => null,
        'url'                 => null,
        'website'             => null,
        'youtube'             => null,
    );

    public function __construct($college_name = null)
    {
        if (!empty($college_name) && is_string($college_name)) {

            $this->setName($college_name);

        } elseif (is_array($college_name)) {

            foreach ($college_name as $key => $value) {
                $method = 'set' . $this->toCamelCase($key);
                call_user_func(array($this, $method), $value);
            }

        }
    }

    public function setUrl($url)
    {
        return $this;
    }

    public function setName($college_name)
    {
        $this->data['name'] = $college_name;

        $this->data['url'] = $this->generateUrl();

        return $this;
    }

    public function setNickname($nickname)
    {
        $this->data['nickname'] = $nickname;

        $this->data['url'] = $this->generateUrl();

        return $this;
    }

    private function generateUrl()
    {
        $clean_name = preg_replace('@[^a-zA-Z0-9\s-_]@', null, strtolower(trim($this->data['name'])));

        return trim(str_replace(array(' ', '_'), '-', $clean_name . '-' . strtolower(trim($this->data['nickname']))), '-');
    }
}
