<? require 'currents.php'; ?>
<!DOCTYPE html>
<html>
  <meta charset="utf-8">
  <head>
    <title>John Holdun</title>
    <style>
      body { background: black; margin: 24px auto; color: white; width: 600px; font-family: "Georgia"; text-shadow: 1px 1px 1px black; font-size: 24px; line-height: 1.5; }
      p { margin-bottom: 1em; }
      a { color: #99F; text-decoration: none; }
      ul { list-style: none; overflow: hidden; margin: 0; padding: 0; font-size: 20px; }
      li { float: left; margin-right: 12px; }
      li:after { content: "\2022"; margin-left: 12px; }
      li:last-child:after { display: none; }
    </style>
  </head>
  <body>  
    <p>I&rsquo;m John Holdun. I design interactions for the web.</p>
    
    <p><?= current_status() ?></p>
    
    <p>I&rsquo;m currently in <?= current_city() ?>.</p>
    
    <ul>
<? foreach(links() as $link) : ?>
      <li><a href="<?= $link->url ?>"><?= $link->text ?></a></li>
<? endforeach; ?>
    </ul>
  </body>
</html>