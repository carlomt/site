<?php 
$config = parse_ini_file('config.ini');

echo "<div class=\"row\">";
echo "<div class=\"col-sm-5\" >";
if (isset($config['logo']))
  {
    echo "<div class=\"row\">";
    echo "<div class=\"col-xs-12\">";
    echo "<img style=\"max-height:100px; margin-left:-75px;\" src=\"".htmlspecialchars($config['logo'], ENT_QUOTES, 'UTF-8')."\">";
    echo "</div>";
    echo "</div>";
  }
if (isset($config['logo2']))
  {
    echo "<div class=\"row\">";
    echo "<div class=\"col-xs-12\">";
    echo "<img style=\"max-height:80px;\" src=\"".htmlspecialchars($config['logo2'], ENT_QUOTES, 'UTF-8')."\">";
    echo "</div>";
    echo "</div>";
  }
if (isset($config['logo-safe']))
  {
    echo "<div class=\"row\">";
    echo "<div class=\"col-xs-12\">";
    echo "<a href=\"https://web.uniroma1.it/fac_smfn/questione-di-genere\" target=\"_blank\">";
    echo "<img style=\"max-height:80px;\" src=\"".htmlspecialchars($config['logo-safe'], ENT_QUOTES, 'UTF-8')."\">";
    echo "</a>";
    echo "</div>";
    echo "</div>";
  }

if (isset($config['short_description']))
  {
    echo $config['short_description'];
  }

echo "</div>";

echo "<div class=\"col-sm-7\" >";

if (isset($config['home_img']))
  {
    echo "<img class=\"img-thumbnail\" src=\"";
    echo $config['home_img'];
    echo"\"> \n";
  }

echo "</div>";
echo "</div>";

echo "<div class=\"row\">";
echo "<div class=\"col-sm-12\" >";
echo "<h3>Contacts:</h3>";
echo "<p>";
echo "<ul class=\"icon\">";
if (isset($config['email']))
  {
    echo "<li class=\"envelope\"> ";
    echo "email: <a href=\"mailto:";
    echo $config['email'];			 
    echo " rel=\"nofollow\">";
    echo $config['email'];			 
    echo"</a></li>";
  }
if (isset($config['skype']))
  {
    echo "<li class=\"comment\"> ";
    echo "skype: ";
    echo $config['skype'];			 
    echo"</li>";
  }
if (isset($config['telephone']))
  {
    echo "<li class=\"phone-alt\"> ";
    echo "telephone: ";
    echo $config['telephone'];			 
    echo"</li>";
  }

if (isset($config['address']))
  {
    echo "<li class=\"map-marker\"> "; 
    echo "address: ";
    echo $config['address'];
    echo "</li>";
  }

echo "</li>";
echo "</ul>";
echo "</p>";
echo "</div>";
echo "</div>";

?>
