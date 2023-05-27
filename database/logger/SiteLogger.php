<?php

namespace Database\Logger;

use Monolog\Logger;

class SiteLogger
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function __invoke()
    {
        $logger = new Logger('DatabaseLogHandler');
        return $logger->pushHandler(new DatabaseLogHandler);
    }

}
