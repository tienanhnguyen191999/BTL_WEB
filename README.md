How to install
1. Install Xampp
2. Clone this repository to C:xampp/htdocs
3. Change httpd.conf 
  - Change [ 
		DocumentRoot "C:/xampp/htdocs"
		<Directory "C:/xampp/htdocs">
		=>  
		DocumentRoot "C:/xampp/htdocs/BTL_WEB"
		<Directory "C:/xampp/htdocs/BTL_WEB">

4. Open phpmyadmin 127.0.0.1/phpmyadmin
   - Create Schema(Table) btl_web
   - Import from C:\xampp\htdocs\BTL_WEB\sql_import
5. Cheer :) 