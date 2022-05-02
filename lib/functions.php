<?php

function _e($val) {
  $val = trim($val);
  $val = stripslashes($val);
  $val = htmlspecialchars($val, ENT_QUOTES);

  return $val;
}