<?php
header('Access-Control-Allow-Origin: *');

trait Request
{
  final private static string $baseUrl = "https://splits.io/api/v4/";
  private string $requestId;

  public static function getRequestUrl(): string
  {
    return self::$baseUrl . self::$endpoint . self::$requestId;
  }

  public function send(): void
  {
    $ch = curl_init(self::getRequestUrl());

    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ("Accept: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
  }
}

$endpoints = array("runs", "runners", "games", "categories", "segments");
class RunRequest
{
  use Request;
  private static string $endpoint = "runs/";
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