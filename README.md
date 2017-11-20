# rankwatch17_php_curl_meta



The code is being made to find all the Through CURL Request find meta keywords, meta description, title tag, IP address, Load Time, HTTP Status, Internal & External Links of any URL. It is working in mostly all websites.

  IP Address =  to find Ip adress of server we use  $_SERVER['REMOTE_ADDR']. it will return ip address of server.
  Load Time=to find out load time we create a timer function and then call it.
  
  meta keywords, meta description, title tag =  we use function file_get_contents_curl($url) This function is the preferred way to read the contents of a WebPage  into a string.then we parse the data which we get form funtion and display.

//FOR HTTP STAtUS
I use some function and then print http status 
