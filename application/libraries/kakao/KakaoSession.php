<?php

class KakaoSession
{

  /**
   * @var string
   */
  private static $defaultAppId;

  /**
   * @var string
   */
  private static $defaultAppSecret;

  /**
   * @var string
   */
  private $accessToken;


  public function __construct($accessToken)
  {
    $this->accessToken = $accessToken;
  }

  /**
   * Returns the access token.
   *
   * @return string
   */
  public function getToken()
  {
    return (string) $this->accessToken;
  }

  public function getExchangeToken($appId = null, $appSecret = null)
  {
    return false;
  }

}
