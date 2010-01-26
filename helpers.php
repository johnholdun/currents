<?php

# How nice!
function json_decode_file($filename) {
  return json_decode(file_get_contents($filename));
}

# Word array, like Ruby's %w[]
function w($words) {
  return split(' ', $words);
}

function array_to_object($array) {
	if (!is_array($array)) {
		return $array;
	} else if (count($array) > 0) {
	  foreach ($array as &$item) {
	    $item = array_to_object($item);
	  }
	  
	  return (object) $array;
	} else {
    return false;
  }
}