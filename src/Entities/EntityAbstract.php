<?php

namespace CollegeFB\Entities;

abstract class EntityAbstract
{
    protected $data = array();

    protected function fromCamelCase($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);

        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }

        return implode('_', $ret);
    }

    protected function toCamelCase($str)
    {
        return preg_replace_callback('/_([a-z])/', create_function('$c', 'return strtoupper($c[1]);'), $str);
    }

    public function __call($method, $params)
    {
        $var = $this->fromCamelCase(substr($method, 3));

        if ('id' === $var) {
            $var = '_id';
        }

        if (0 === strncasecmp($method, 'get', 3)) {
            return (array_key_exists($var, $this->data)) ? $this->data[$var] : null;
        }

        if (0 === strncasecmp($method, 'set', 3)) {
            if (array_key_exists($var, $this->data)) {
                $this->data[$var] = $params[0];
            }

            return $this;
        }

        if (0 === strncasecmp($method, 'has', 3)) {
            return (array_key_exists($var, $this->data));
        }

        return false;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setUrl($url)
    {
        return null;
    }
}
