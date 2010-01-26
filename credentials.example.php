<?php

require_once 'helpers.php';

# Obviously, replace these values with your own.
# I haven't bothered with Twitter credentials.
# If you're protecting your updates, stop doing that.
# Also, Shaq, if you're using this code, please get in touch.
$credentials = array_to_object(array(
  'dopplr' => array(
    'token' => 'secret'
  ),
  'twitter' => array(
    'username' => 'the_real_shaq'
  ),
  'bitly' => array(
    'username' => 'blowfish',
    'key' => 'another_secret'
  )
));