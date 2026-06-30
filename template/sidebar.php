<?php $config = parse_ini_file('config.ini'); 

if (isset($config['sidebar_links']))
{
  echo "<div class=\"panel panel-default\">\n";
  echo "<div class=\"panel panel-heading\">\n";
  echo "Links";
  echo "</div>\n";
  
  echo "<ul class=\"list-group\">";
  $links = $config['sidebar_links'];
  /* foreach (array_combine($config['links'], $config['names']) as $link => $name)  */
  foreach( $links as $name => $link ) 
    {
      echo "<li class=\"list-group-item\"><a href=\"";
      echo htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
      echo "\" target=\"blank\">";
      echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
      echo "</a></li>";
    }
  echo "</ul>";
  
  echo "</div>\n";

}

?>