<?php

namespace Database\Logger;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Writer
{
    /**
     * undocumented function
     *
     * @return void
     */
    public function write(array $item)
    {
        try {
            DB::connection(config('logging.channels.site.connection'))
                ->table(config('logging.channels.site.table'))
                ->insert($item);
        } catch (\Exception $e) {
            Log::channel(config('logging.channels.site.alternative'))
                ->error(sprintf(
                    'Message error: %s; From: %s:%s',
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine()
                ));
        }
    }
}
