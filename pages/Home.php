<?php 
$config = parse_ini_file('config.ini');

echo "<div class=\"row\">";
echo "<div class=\"col-sm-5\" >";
echo "<div class=\"row\">";
if (isset($config['logo']))
  {
    echo "<div class=\"col-md4\" >";	
    // echo "<img class=\"img-responsive float-left max-width: auto; height: 100;\" src=\"".$config['logo']."\">";
    echo "<img class=\"img-responsive max-height: 100px; max-width: 200px\" src=\"".$config['logo']."\">";
    echo "</div>"; 
  }
if (isset($config['logo2']))
  {
    echo "<div class=\"col-m3 ml-md-auto\" >";
//    echo "<img class=\"img-responsive float-right max-width: auto; height: 100;\" src=\"".$config['logo2']."\">";
    echo "<img class=\"img-responsive max-height: 100px;\" src=\"".$config['logo2']."\">";
    echo "</div>";
  }

echo "</div>";
echo "<div class=\"row\">";
if (isset($config['logo-safe']))
  {
    echo "<div class=\"col\" >";
    echo "<a href=\"https://web.uniroma1.it/fac_smfn/questione-di-genere\" target=blank>";
    echo "<img class=\"img-responsive max-width: 100%; height: auto;\" src=\"".$config['logo-safe']."\">";
    echo "</a>";
    echo "</div>"; 
  }
echo "</div>";

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
