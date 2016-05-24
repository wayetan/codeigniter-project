<?php
 if (!defined('BASEPATH')) {
     exit('No direct script access allowed');
 }
/*
| -------------------------------------------------------------------------
| Settings.
| -------------------------------------------------------------------------
*/
$config['app_id'] = '187027071693230';        // Your app id
$config['app_secret'] = 'cfbe41f87d03812fa0b9866838cd6ca5';        // Your app secret key
$config['scope'] = 'email';    // custom permissions check - http://developers.facebook.com/docs/reference/login/#permissions
$config['redirect_uri'] = '';        // url to redirect back from facebook. If set to '', site_url('') will be used
