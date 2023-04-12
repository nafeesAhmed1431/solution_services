<?php
require APPPATH . 'libraries/fpdf/fpdf.php';
require APPPATH . 'libraries/fpdi/fpdi.php';

class FPDI_Bridge extends FPDI {
  function __construct($orientation='P', $unit='mm', $size='A4') {
    parent::__construct($orientation, $unit, $size);
  }
}
