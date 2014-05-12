<?php

namespace Midnight\RedirectModule\Storage;

interface StorageInterface
{
    /**
     * @param string $from
     *
     * @return string
     */
    public function getTo($from);

    /**
     * @param string $from
     * @param string $to
     *
     * @return void
     */
    public function create($from, $to);
}