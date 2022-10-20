
#!/bin/bash
yum -y update all
amazon-linux-extras enable php8.0
yum -y clean metadata
yum -y install httpd php php-gd php-mysqlnd
service httpd start
Restart httpd
service httpd start


======================
Edit httpd configuration:

sudo nano /etc/httpd/conf/httpd.conf
So that served directory allow .htaccess overides:

/var/www/html -> AllowOverride All

=====================
<?php

  echo "<table class='table table-bordered'>";
  echo "<tr><th>Meta-Data</th><th>Value</th></tr>";

  #The URL root is the AWS meta data service URL where metadata
  # requests regarding the running instance can be made
  $urlRoot="http://169.254.169.254/latest/meta-data/";

  # Get the instance ID from meta-data and print to the screen
  echo "<tr><td>InstanceId</td><td><i>" . file_get_contents($urlRoot . 'instance-id') . "</i></td><tr>";

  # Availability Zone
  echo "<tr><td>Availability Zone</td><td><i>" . file_get_contents($urlRoot . 'placement/availability-zone') . "</i></td><tr>";

  echo "</table>";

?>
=======================

<?php
phpinfo();
?>