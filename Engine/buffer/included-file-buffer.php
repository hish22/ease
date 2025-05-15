<?php

namespace Engine\Buffer;

use Common\DS\Queue;

trait IncludedFileBuffer {
    /**
     * A Queue to track the included and imported files
     * @var Queue
     */
    private static Queue $partial_files_Queue;

    /**
     * Initialization of the partial files Stack
     * @return void
     */
    protected static function init_partial_files_queue(): void {
        if(PARSETYPE == "partial") {
            self::$partial_files_Queue = new Queue();
        }
    }

    protected static function enqueueToPratialQueue($value): void {
        self::$partial_files_Queue->enqueue($value);
    }

    protected static function dequeueFromPartialQueue(): string {
        return self::$partial_files_Queue->dequeue();
    }

    protected static function partialQueue(): array {
        return self::$partial_files_Queue->queue();
    }

}