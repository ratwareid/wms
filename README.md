# wms
Warehouse Management System 

Before Start :
-Install Apache , Php and Mysql 
if you are using windows just download AppServ
-Enable Rewrite Access on your server / PC
For Windows you can read on this article : https://tomelliott.com/php/mod_rewrite-windows-apache-url-rewriting

How To Setup : 
1. Download Source Code  
2. Extract to www folder of your own webserver
3. Open database config on application/config/database.php
4. Set password for your database on 'password' => 'YOUR_PASSWORD_DB'
5. Open file <a href="https://github.com/ratwareid/wms/blob/master/wms.sql">wms.sql</a> 
6. Open PhpMyAdmin then create database with name "wms"
7. Open database wms then click tab SQL
8. Copy script sql on wms.sql then paste to SQL tab in PhpMyAdmin in database wms then run script
5. Open url http://youripwebserver/wms or http://localhost/wms 

Thanks to Boostrap , CI , AdminLTE , Apache 

Best Regards 

Jerry Erlangga
Ratwareid

