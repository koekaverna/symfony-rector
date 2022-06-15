<?php

namespace App\Rector;

class RectorTest
{
    public function __construct(
        private \Redis $redis,
        private string $value
    )
    {
    }

    public function save(): void
    {
        $this->redis->set(
            'key',
            $this->value,
        );
    }
}
