<?php declare(strict_types=1);
header("Access-Control-Allow-Origin: *");



enum RequestType
{
  case RUN;
  case RUNNER;
  case GAME;
  case SEGMENT;
  case CATEGORY;
}

class Request
{
  private string $endpoint;
  public int $historic;
  public string $url;
  private static string $baseUrl = "https://splits.io/api/v4/";
  private string $requestId;
  private array $queryParams;

  function __construct(string $id, RequestType $requestType, mixed $queryData = null)
  {
    $this->requestId = $id;
    switch ($requestType) {
      case RequestType::RUN:
        $this->endpoint = "runs/";
        if (isset($queryData))
          $this->queryParams = array('historic' => $queryData->historic);
        break;
      case RequestType::RUNNER:
        $this->endpoint = "runners/";
        break;
      case RequestType::GAME:
        $this->endpoint = "games/";
        break;
      case RequestType::SEGMENT:
        $this->endpoint = "segments/";
        break;
      case RequestType::CATEGORY:
        $this->endpoint = "categories/";
        break;
      default:
        break;
    }
  }

  public function getRequestUrl(): string
  {
    $url = self::$baseUrl . $this->endpoint . $this->requestId;
    if (isset($this->queryParams) && count($this->queryParams) > 0)
      $url = $url . http_build_query($this->queryParams);
    return $url;
  }

  public function send(): void
  {
    $ch = curl_init($this->getRequestUrl());

    curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    echo $response;
  }
}

$request = new Request("9okq", RequestType::RUN);
$request->send();
?>