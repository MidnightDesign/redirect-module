<?php

namespace Midnight\RedirectModule;

class Redirect
{
    /**
     * @var string
     */
    private $from;
    /**
     * @var string
     */
    private $to;

    /**
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @param string $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }
} 