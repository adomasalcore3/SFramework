<?php

/*
** SplashFramework
** Copyright: (Soon in) licence.splashframe.tk
** you can copy this repo, and use it, modify it
** when it is being developed here.
*/
define('SF_Path',dirname(__FILE__));
/*
** Define the base system dir
*/
define('Sys',SF_Path.'/System');
/*
** define the base app dir
*/
define('App',SF_Path.'/Application');
/*
** define the base asset dir
*/
define('Asset',App.'/Asset');
/*
** Security defined var
*/
define('Sec',TRUE);
/*
**Core config load
*/
require_once(SP_Path.'/core.php');
/*
** start the process before the init of the core
*/
require_once(Sys.'/Core/SFcore.php');
/*
** core init
*/
$SF=&get_instance();

//$SF->load->library();
//$SF->load->functions();
//$SF->load->themes();

/*
**aplication call (on the end of this file).
*/
$SF=&get_instance();
$SF->load->__class('Application');