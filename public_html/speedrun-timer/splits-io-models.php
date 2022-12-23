<?php declare(strict_types=1);

namespace SplitsIO;

enum GameTimingMethod:string {
  case Real = "Real";
  case Game = "Game";
}

class Runner
{
  public string $id;
  public null|string $twitch_id;
  public null|string $twitch_name;
  public string $display_name;
  public string $name;
  public string $avatar;
  public string $created_at;
  public string $updated_at;
}

class Category
{
  public string $id;
  public string $name;
  public string $created_at;
  public string $updated_at;
}

class Game
{
  public string $id;
  public string $name;
  public string $shortname;
  public string $created_at;
  public string $updated_at;
  /**
   * @var Category[]
   */
  public $categories;
  public null|string $srdc_id;
  public null|string $cover_url;
}

class Segment 
{
  public string $id;
  public string $name;
  public string $display_name;
  public int $segment_number; 

  public int $realtime_start_ms;
  public int $realtime_duration_ms;
  public int $realtime_end_ms;
  public null|int $realtime_shortest_duration_ms;
  public bool $realtime_gold;
  public bool $realtime_skipped;
  public bool $realtime_reduced;
  
  public int $gametime_start_ms;
  public int $gametime_duration_ms;
  public int $gametime_end_ms;
  public null|int $gametime_shortest_duration_ms;
  public bool $gametime_gold;
  public bool $gametime_skipped;
  public bool $gametime_reduced;
}

class History
{
  public int $attempt_number;
  public int $realtime_duration_ms;
  public int $gametime_duration_ms;
  public null|string $started_at;
  public null|string $ended_at;
}

class Run
{
  public string $id;
  public null|string $srdc_id;

  public float $realtime_duration_ms;
  public float $realtime_sum_of_best_ms;

  public float $gametime_duration_ms;
  public float $gametime_sum_of_best_ms;

  public GameTimingMethod $default_timing;
  public string $program;
  public int $attempts;
  public bool $uses_autosplitter;
  public string $created_at;
  public string $updated_at;
  public null|string $parsed_at;
  public null|string $image_url;
  public null|string $video_url;

  public null|Game $game;
  public null|Category $category;
  /**
  * @var Runner[]
  */
  public $runners;
  /**
  * @var Segment[]
  */
  public $segments;
  /**
   * @var null|History[]
   */
  public $histories;
}

?>