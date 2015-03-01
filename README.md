
# GameStatus v2
### By Jeremy Paton

Copyright (c) Forge Gaming Network 2015

GameStatus v2, is a simple but effective script which you can use to display the status of a multiple game servers. The script simply needs to be called at intervals you can set.

What is GameStatus v2
-----------------
The script is divided into two main components:
- serverstatus.php: The script which checks each listed server and produces a JSON file with the results. We recommend running this script via CRON every 5/10min.

- serverstatusplugin.php: A Wordpress script (It is not actually a plugin), which displays the JSON file as an unstyled table. 

Features
-------------
- Simple & Lightweight script
- Basic error checking
- Simple text file stores server details
- Displayed data is effectively cached
- Displayed data is seperate from checker script
- JSON file could potentially be hosted elsewhere
- Display only selected games. E.g: CSGO or MC

Screenshots
-----------------
#### How we use it
![End Result](http://i.imgur.com/V1uMJwo.png)

Requirments
--------------
- php 5.4 minimum
- Requires **@fsockopen**

Add a server to check
--------------
- Open the serverlist.txt
- Add server as new line **follow styling!**

| GAME CODE | SERVER NAME | IP          | Port   |
|:---------:|:-----------:|:-----------:|:------:|
| MC        | Minecraft   | 192.168.1.1 | 25565  |

- GAME CODE: Used in shortcode must be identical!

Installation
--------------
- Drop onto server
- CRONJOB the serverstatus.php to run every 5 min
- Check serverstatus.json file is created!

Wordpress Installation
--------------
- Add the following to your functions.php (Should be using Child-Theme!):
```
/* Add FGN ServerStatus Plugin */
include(WP_CONTENT_DIR . '/directory/serverstatusplugin.php');
add_shortcode( 'GetServers_sc', 'GetServers' );
```
- Shortcode example, display all: [GetServers_sc] 
- Shortcode example, display specific game: [GetServers_sc game="MC"] 
