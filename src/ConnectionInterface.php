<?php

namespace Reamp;

/**
 * The version of Reamp(Ratchet) being used.
 * @var string
 */
const VERSION = 'Reamp (Ratchet/0.4.1)';

/**
 * A proxy object representing a connection to the application
 * This acts as a container to store data (in memory) about the connection.
 */
interface ConnectionInterface {
    /**
     * Send data to the connection.
     * @param  string $data
     * @return \Reamp\ConnectionInterface
     */
    public function send($data);

    /**
     * Close the connection.
     */
    public function close();

    /**
     * @return int Connection id
     */
    public function id();

    /**
     * @return string Remote address
     */
    public function getRemoteAddress();
}