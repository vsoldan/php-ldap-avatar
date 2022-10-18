<?php
##############################################################################################################
# Description: This script is returning thumbnailPhoto variable from a Microsoft AD domain. 
#              If the variable is empty or not set the script will return a default image from folder images
# Author: Viorel Soldan
# Date: 18 Octomber 2022
# Version: 1.0
##############################################################################################################

# Include the global configuration file
include('include/config.php');

# Read the URL variable email
$email = $_GET['email'];

# Get content of thumbnailPhoto content from a LDAP server
$u = "";
if (isset($email) and filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $ldap = ldap_connect($LDAPServer, 3268);
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_bind($ldap, $LDAPUser, $LDAPPass) or die ("No LDAP bind to ".$LDAPServer);
    $filter = '(mail='.$email.')';
    $sr = ldap_search($ldap, $DN, $filter, array('thumbnailphoto'));
    $u = ldap_get_entries($ldap, $sr);
}

# Output the content
# Set the output type to JPG image 
header('Content-Type: image/jpeg');

# Instruct browser to cache the item up to $CACHETime
$ts = gmdate('D, d M Y H:i:s', time() + $CACHETime) . ' GMT';
header('Expires: $ts');
header('Pragma: cache');
header('Cache-Control: max-age=$CACHETime');

if (isset($u[0]['thumbnailphoto'])) {
       # Return the thumbnailphoto raw content
       echo $u[0]['thumbnailphoto'][0];
 } else {
       # Return the default image
       $fp = fopen('images/Default-profile-photo.jpg', 'r');
       fpassthru($fp);
}
?>