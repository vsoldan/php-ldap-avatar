# PHP LDAP Avatar 
Script to return user photo from a Microsoft AD domain (thumbnailPhoto variable) based on provided e-mail GET variable


Installation
-----------------------------------------------------------
1. Upload the content on a web server keeping the same structure
2. Edit the **include/config.php** file with your variables
3. Open a browser and check the https://domain.ro/avatar.php?email=test@domain.ro 
4. If an image is returned, everything is OK

Embed
------------------------------------------------------------
1. You can embed the **avatar.php** in your projects by inserting **`<img src="https://domain.ro/avatar.php?email=test@domain.ro" alt="Avatar" width="100" height="100">`** in your code
