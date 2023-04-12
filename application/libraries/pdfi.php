<?php
require APPPATH . 'libraries/fpdi/fpdi_bridge.php';

class Pdfi extends FPDI_Bridge {
  function __construct($orientation='P', $unit='mm', $size='A4') {
    parent::__construct($orientation, $unit, $size);
  }
}
