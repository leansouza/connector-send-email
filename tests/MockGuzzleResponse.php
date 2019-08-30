<?php

namespace Tests;

class MockGuzzleResponse {
    public function __construct($phpunitResponse)
    {
        $this->response = $phpunitResponse;
    }

    public function getStatusCode()
    {
        return $this->response->status();
    }

    public function getBody()
    {
        return $this->response->getContent();
    }
}