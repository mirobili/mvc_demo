<?php

namespace App\Framework\Cache;

use App\Framework\CacheInterface;
use \Redis;

class RedisCache implements CacheInterface
{
    private $redis;

    public function __construct()
    {
        $this->redis = new Redis();

        try {
            // Connect to Redis

            $this->redis->connect( $_ENV['REDIS_HOST'], $_ENV['REDIS_PORT'] );

            // Authenticate with the password
//            if ($this->redis->auth('mvc_redis_password')) {
//                echo "Authenticated successfully!\n";
//
//                // Test the connection with PING command
//                if ($this->redis->ping()) {
//                    echo "PONG\n"; // Should return PONG if connected successfully
//                }
//            } else {
//                echo "Authentication failed!\n";
//            }
        } catch (Exception $e) {
            echo "Could not connect to Redis: " . $e->getMessage();
        }
    }

    public function get($key, $default = null)
    {
        try {
            $value = $this->redis->get($key);
            return $value !== false ? $value : $default;
        } catch (Exception $e) {
            throw $e->getMessage();
        }
    }

    public function set($key, $value, $ttl = null)
    {
        if ($ttl) {
            $this->redis->setex($key, $ttl, $value);
        } else {
            $this->redis->set($key, $value);
        }
    }

    public function delete($key)
    {
        return $this->redis->del($key);
    }

    public function exists($key)
    {
       return  $this->redis->exists($key);
    }

    public function getKeys()
    {
        return $this->redis->keys('*');
    }
}