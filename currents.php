<?php

# Oh well then thank you
require_once 'helpers.php';

# Just holds $credentials, an object with all my private bits.
require_once 'credentials.php';

# Get all our data situated
$filename = 'data.json';
$data = json_decode_file($filename);
$data_updated = false;

# Refresh status and city each hour
foreach(w('status city') as $type) {
  if (time() - $data->$type->updated_at > 60 * 60) {
    if ($refreshed_text = refresh_text($type)) {
      $data->$type->text = $refreshed_text;
    }
    
    $data->$type->updated_at = time();
    $data_updated = true;
  }
}

# Should be bother rewriting the JSON file?
if ($data_updated) {
  file_put_contents($filename, json_encode($data));
}

# Fetch fresh information
function refresh_text($type) {
  global $credentials;
  
  # Get all our API functions
  require_once 'resources.php';
  
  switch($type) {
    case 'city':
      $traveller = dopplr_get_traveller($credentials->dopplr->token);
      $city = $traveller->current_city->name;
      
      # We don't want no widows in our city name
      return str_replace(' ', '&nbsp;', $city);
      break;
      
    case 'status':
      $toot = twitter_get_toot($credentials->twitter->username);
      
      # Expand bit.ly URLs
      if (preg_match('/href="(http:\/\/bit.ly[^"]+)"/', $toot, $urls)) {
        $url = $urls[1];
        $new_url = bitly_expand($url, $credentials->bitly->username, $credentials->bitly->key);
        $toot = str_replace($url, $new_url, $toot);
      }

      return $toot;
      break;
    
    default:
      
      # What? What more do you want?
      return false;
      break;
    }
}

# More helpers. Why not?
function current_city()   { global $data; return $data->city->text;   };
function current_status() { global $data; return $data->status->text; };
function links()          { global $data; return $data->links;        };