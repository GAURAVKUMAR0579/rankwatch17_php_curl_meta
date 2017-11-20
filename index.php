
<form method="get">
	<input type="text" name="url" placeholder="Enter URL">
	<input type="submit" name="submit">
</form>

<?php

//Ip Address

echo '<h2 style="color:blue;">Server Ip address is  :</h2>';
echo $_SERVER['REMOTE_ADDR']."<br>";


//Load Time 

function timer()//timer Function
{
    static $initial;

    if (is_null($initial))
    {
        $initial = microtime(true);
    }
    else
    {
        $difference = round((microtime(true) - $initial), 4);
        $initial = null;
        return $difference;
    }
}

timer();// Call Timer Function

echo '<h2 style="color:blue;">Page genarated in :</h2>';
echo ' ' . timer() . ' seconds.<br><br>';// Print Load Time

function file_get_contents_curl($url)
//This function is the preferred way to read the contents of a WebPage  into a string
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $info = curl_exec($ch);
    curl_close($ch);

    return $info;
}




if(isset($_GET['submit']))
{
	$url=$_GET['url'];
	$html = file_get_contents_curl($url);

//parsing begins here:
$doc = new DOMDocument();
@$doc->loadHTML($html);
$nodes = $doc->getElementsByTagName('title');//Title tag

//get and display what you need:
$title = $nodes->item(0)->nodeValue;

$metas = $doc->getElementsByTagName('meta');

for ($i = 0; $i < $metas->length; $i++)
{
    $meta = $metas->item($i);
    if($meta->getAttribute('name') == 'description') //For Meta Description
        $description = $meta->getAttribute('content');
    if($meta->getAttribute('name') == 'keywords')//For Meta Keyword
        $keywords = $meta->getAttribute('content');
}
echo '<h2 style="color:blue;">Title :</h2>';
echo "$title". '<br/><br/>';//print Title tag
echo '<h2 style="color:blue;">  Meta Description: :</h2>';
echo " $description". '<br/><br/>';//Print For Meta Description
echo '<h2 style="color:blue;">Meta Keyword :</h2>';
echo "Keywords: $keywords"."<br><br>";//Print For Meta Keyword

}

//FOR HTTP STAtUS
$url=$_GET['url'];
$ch = curl_init($url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_TIMEOUT,10);
$output = curl_exec($ch);
$httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo  '<h2 style="color:blue;">HTTP Status is:</h2>';
echo $httpstatus;

?>