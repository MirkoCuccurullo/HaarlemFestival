<?php
$db_host="mysql";
$db_name="developmentdb";
$db_username="root";
$db_password="secret123";

if(!defined('GOOGLE_CLIENT_ID')) {define('GOOGLE_CLIENT_ID', '520944810984-r8t29cncqdo4tsv4cbl4jji0ti274q1s.apps.googleusercontent.com');}
if(!defined('GOOGLE_CLIENT_SECRET')){define('GOOGLE_CLIENT_SECRET', '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');}
if(!defined('GOOGLE_OAUTH_SCOPE')){define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/calendar');}
if(!defined('REDIRECT_URI')){define('REDIRECT_URI', 'http://localhost/API/google_calendar_event_sync.php');}

//Google OAuth URL

$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode(GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' . REDIRECT_URI . '&response_type=code&client_id=' .GOOGLE_CLIENT_ID.
    '&access_type=online';

