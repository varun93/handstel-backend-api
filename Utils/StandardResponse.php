<?php

namespace Utils;

class StandardResponse
{
var $status;
var $http_status;
var $payload;

public function __construct($status=0,$http_status=200,$payload)
{
$this->status = $status;
$this->http_status = $http_status;
$this->payload = $payload;
}

}

?>