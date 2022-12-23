<?php

class RunRequest
{
  public string $runId;
  public int $historic;
  public string $url;
  static private string $baseUrl = "https://splits.io/api/v4/runs/";

  function __construct(string $runId, int $historic = 0)
  {
    $this->runId = $runId;
    $this->historic = $historic;
    $this->constructRequestUrl();
  }

  function constructRequestUrl()
  {
    $url = self::$baseUrl . $this->runId;
    if ($this->historic > 0)
      $url = $url . "?historic={$this->historic}";
    $this->url = $url;
  }
  #CURLOPT_HTTPHEADER	An array of HTTP header fields to set, in the format array:
  #('Content-type: text/plain', 'Content-length: 100')
  function send()
  {
    $ch = curl_init($this->url);

    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    echo json_encode($response);
    curl_close($ch);
  }
}

?>