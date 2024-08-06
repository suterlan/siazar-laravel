<?php

namespace App\Services\Siswa;

use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class NisService
{
  protected $nis;
  protected $year;
  protected $month;
  protected $day;

  public function __construct($year, $month, $day)
  {
    $this->nis = DB::table('siswas')
      ->select(DB::raw('MAX(RIGHT(nis, 3)) as last_nis'))
      ->where(DB::raw('YEAR(created_at)'), $year)
      ->orderBy('id', 'desc')
      ->first();

    $this->year   = $year;
    $this->month  = $month;
    $this->day    = $day;
  }

  public function createNis()
  {
    if (!blank($this->nis)) {
      $lastNis = $this->nis->last_nis;
      $next_nis = (int) $lastNis + 1;
      $new_nis = sprintf('%03s', $next_nis);
    } else {
      $new_nis = '001';
    }

    $nis = $this->year . $this->month . $this->day . $new_nis;
    return $nis;
  }
}
