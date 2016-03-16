# SPFramework
##base aspects
if you know CodeIgniter, part of this framework is similar to it.
this framework uses the "theme" and plugin structure.
you can have languages in files and in the database.
##base structure
works with the singleton structure.
##base core calls
###Example of use
/*
** normal use
*/
$yourvar=&get_instance();
$yourvar->load->library('Your library');
####to unload an normal library
$yourvar->unload->library('Your library');
####to unload all called librarys on the application
$yourvar->unload->library('Your library');
/*
** autoload structure:
*/
$yourvar=&get_instance();
####permanent load
$yourvar->load->p_library('Your library');
####permanent unload
$yourvar->unload->p_library('Your library');
####on the end of the loads:
$yourvar=&get_instance(); /* Again */
