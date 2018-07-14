<?PHP
@error_reporting(E_ALL, ~E_NOTICE); 
ob_start(); 
@session_start();

ini_set("allow_url_include","Off"); 
ini_set("allow_url_fopen","Off"); 
ini_set("register_globals","Off"); 
ini_set("safe_mode","On");

// Подгрузка ядра 
require_once("config.php");
require_once(SOURCE_DIR."/config_db.php");
require_once(SOURCE_DIR."/init_db.php");
require_once(SOURCE_DIR."/init_source.php");

	function sf($str)
    {
        return mysql_real_escape_string(strip_tags(htmlspecialchars($str))); 
    }

$link=sf($_GET[link]);
$row=mysql_fetch_assoc(mysql_query("SELECT * FROM abanner WHERE id='$link'"));
$url_go[url]=$row[href];
if($row[id]==false){echo ''; exit;}
mysql_query("UPDATE abanner set views=views+1 WHERE id='$link'") or die(mysql_error());
?>
		<meta http-equiv="refresh" content="0; url=<?=$url_go["url"]; ?>">
		<?PHP
		
?>