<?php

namespace App\Services\QRCode;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeService
{
  protected $link;

  public function __construct($link)
  {
    $this->link = $link;
  }

  public function generate()
  {
    $qr = QrCode::format('svg')->size(120)
      ->generate($this->link);
    return $qr;
  }
}
