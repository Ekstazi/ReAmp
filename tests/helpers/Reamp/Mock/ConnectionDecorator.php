<?php

namespace Reamp\Mock;

use Reamp\AbstractConnectionDecorator;

class ConnectionDecorator extends AbstractConnectionDecorator {
    public $last = [
        'write' => '', 'end'   => false
    ];

    public function send($data) {
        $this->last[__FUNCTION__] = $data;

        $this->getConnection()->send($data);
    }

    public function close() {
        $this->last[__FUNCTION__] = true;

        $this->getConnection()->close();
    }
}