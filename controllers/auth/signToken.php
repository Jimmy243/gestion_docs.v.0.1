<?php

use Firebase\JWT\JWT;

function signToken($payload){
  $private_key = "eyJpZCI6Miwicm9sZSI6IiBBRE1JTiIsImlhdCI6MTmYzMzk2NjE2NCwiZXhwIjoxNjMzOTY2NDY0fQ";
  $token = JWT::encode($payload, $private_key, "HS256");
  return $token;
}