<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1 
header('Content-Type: text/javascript; charset=UTF-8');
#set date to count down to.  Both 24 or 12h formats work
$endDate = strtotime("September 01, 2014 12:00 am");
#get time from server
$nowTime = time();
#figure out how much time is left
$remaining = $endDate - $nowTime;
 
#if there is time left, push the end date to JSON, 
#if there isn't any time left push actual now time to JSON, so there are no dates in the past.
if ($remaining > 0 ){
	$timestamp = $endDate;
}else{
	$timestamp = $nowTime;
}
 
# JSONP "callback" param explanation, via basic PHP script.
# 
# "Cowboy" Ben Alman
# http://benalman.com/
 
# Set $data to something that will be serialized into JSON. 
$data = array("nowTime" => $nowTime, "endDate" => $timestamp);
 
# Encode $data into a JSON string.
$json = json_encode($data);
 
# If a "callback" GET parameter was passed, use its value, otherwise null. Note
# that "callback" is a defacto standard for the JSONP function name, but it may
# be called something else, or not implemented at all. For example, Flickr uses
# "jsonpcallback" for their API.
$jsonp_callback = isset($_GET['callback']) ? $_GET['callback'] : null;
 
# If a JSONP callback was specified, print the JSON data surrounded in that,
# otherwise just print out the JSON data.
# 
# Specifying no callback param would print: {"some_key": "some_value"}
# But specifying ?callback=foo would print: foo({"some_key": "some_value"})
print $jsonp_callback ? "$jsonp_callback($json)" : $json;

?>