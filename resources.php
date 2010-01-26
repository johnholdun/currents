<?php

require_once 'smartypants.php';
require_once 'helpers.php';

function twitter_get_toot($username) {
  $url = "http://twitter.com/statuses/user_timeline.json?count=25&screen_name=$username";
  $toots = json_decode_file($url);
  
  foreach ($toots as $toot) {
    $toot = $toot->text;
  
    # Find the first toot that starts with "I" (or "I'm" etc.) and isn't all caps
    if (preg_match('/^I[^A-Za-z]/', $toot) and $toot != strtoupper($toot)) {
      $toot = SmartyPants($toot);
  
      # Turns *asterisized* text into <em>emphasized</em> text
      # This could be more complex but (bold, underline) but it works for me
      $toot = preg_replace('/\*(.+?)\*/', '<em>\1</em>', $toot);
      
      # Add a hyperlink to text that ends in a URL
      if (preg_match('/http:\/\/[^ ]+/', $toot, $urls)) {
        $url = $urls[0];
        
        # Pull that guy outta there
        $toot = trim(str_replace($url, '', $toot));
        
        $toot = "<a href=\"$url\" rel=\"nofollow\">$toot</a>";
      }
      
      return $toot;
    }
  }
}

# Pretty standard stuff.
function dopplr_get_traveller($token) {
  $ch = curl_init();
  curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://www.dopplr.com/api/traveller_info?format=js',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FAILONERROR => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPHEADER => array('Authorization: AuthSub token="{$token}"')
  ));
  
  return json_decode(curl_exec($ch));
}

function bitly_expand($short_url, $username, $key) {
  $bitly_code = str_replace('http://bit.ly/', '', $short_url);
  $bitly_result = json_decode_file("http://api.bit.ly/expand?version=2.0.1&shortUrl={$short_url}&login=$username&apiKey=$key");
  if ($bitly_result->statusCode == 'OK') {
    return $bitly_result->results->$bitly_code->longUrl;
  } else {
    # If something went wrong, just hand it back
    return $short_url;
  }
}