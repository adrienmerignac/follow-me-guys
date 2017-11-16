[![Codacy Badge](https://api.codacy.com/project/badge/Grade/70052363353e4ee7af8af85bb2c05967)](https://www.codacy.com/app/adrienmerignac/follow-me-guys?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=adrienmerignac/follow-me-guys&amp;utm_campaign=Badge_Grade)

FOLLOW-ME
----------------------

Follow-Me is a web api to share your outings with friends or anyone interested.

    Join the community by creating your user
    share your outings
    explore outings of your friends
Screenshoot
------------------------

![](https://raw.githubusercontent.com/adrienmerignac/follow-me-guys/master/resources/Screenshot-2017-11-16%20Follow%20Me.png)
    
Installation:
------------------------

Install Gitbash (https://git-for-windows.github.io/)

Follow-Me requires Composer: dowload here (https://getcomposer.org/download/) or command-line:

$ php composer-setup.php

Next

$ git clone https://github.com/adrienmerignac/follow-me-guys.git
$ composer update
$ bin/console assets:install
$ cd ./web/bundles/followme
$ npm install

Usage:
---------------------------

First Sign up to join the community. Fill the form:

    Title : find a short name to understand
        Description: explain the activity
        Select the date and time start
        Select a duration
        Optional:
            Latitude and longitude
            Web site title and link

Explore the outings
License
-------------

Free Software

Author: Adrien Merignac Contact: adrien.merignac@gmail.com
