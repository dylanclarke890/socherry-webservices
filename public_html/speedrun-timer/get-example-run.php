<?php
header('Access-Control-Allow-Origin: *');
class RunRequest
{
  public string $runId;
  public int $historic;
  public string $url;
  static private string $acceptHeader = "Accept: application/json";
  static private string $baseUrl = "https://splits.io/api/v4/runs/";

  function __construct(string $runId, bool $historic = false)
  {
    $this->runId = $runId;
    $this->historic = $historic;
    $this->constructRequestUrl();
  }

  function constructRequestUrl()
  {
    $url = self::$baseUrl . $this->runId;
    if ($this->historic)
      $url = $url . "?historic=1";
    $this->url = $url;
  }

  function send()
  {
    $ch = curl_init($this->url);

    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, (self::$acceptHeader));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    echo json_encode($response);
  }
}

$request = new RunRequest("9okq");
$request->send();
?>