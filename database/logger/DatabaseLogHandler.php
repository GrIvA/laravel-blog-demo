<?php

namespace Database\Logger;

use Carbon\Carbon;
use Monolog\LogRecord;
use Database\Logger\Writer;
use Monolog\Handler\AbstractProcessingHandler;

class DatabaseLogHandler extends AbstractProcessingHandler
{
    protected function write(LogRecord $record): void
    {
        $item = [
            'level' => $record->level->toPsrLogLevel(),
            'message' => $record['message'],
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'channel' => $record['channel'],
            'remote_addr' => $_SERVER['REMOTE_ADDR'] ?? null,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? null,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s.u'),
        ];

        if (config('logging.channels.site.async')) {
            InsertLogJob::dispatch($item);
        } else {
            (new Writer)->write($item);
        }
    }
}
