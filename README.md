# PHP Time to GMT converter

# Usage
Paste the function into your PHP project and read below about arguments to pass through the function.

# Arguments
The function takes two arguments. ```$tz and $time``` 
 - $tz is either an integer between -13 and 12 including half values such as 6.5 and -3.5
    - $tz (timezone) takes in the difference in hours/minutes from GMT such as GMT+03:00 or GMT-3:30
    
 - $time is a string value in the format "hh:mm" that takes the non GMT time that you want to convert
 
 # Examples
 ```php
echo convertGMT("6","00:23"); // 06:23
echo convertGMT("-3.5","08:23"); // 04:53
echo convertGMT("12","12:02"); // 00:02
 
 ```
