<?php

namespace Test;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

abstract class IntegrationTestCase extends TestCase
{
    protected function setUp(): void
    {
        $dotEnv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotEnv->safeLoad();
    }

    protected function requireEnv(array $keys): void
    {
        $missing = [];

        foreach ($keys as $key) {
            $value = $_ENV[$key] ?? getenv($key);

            if ($value === false || $value === null || $value === '') {
                $missing[] = $key;
            }
        }

        if ($missing !== []) {
            $this->markTestSkipped('Missing environment variables: ' . implode(', ', $missing));
        }
    }
}
