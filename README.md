for run project follow below command: <br>
<br>
1- git clone https://github.com/vahidmohammadi2310/VahidMohamamdi.git <br>
2- docker compose up -d <br>
3- docker exec php_blog composer install <br>
4- docker exec php_blog php artisan migrate --seed <br>
5- docker exec php_blog php artisan key:generate <br>
6- docker exec php_blog chown -R www-data:www-data storage <br>
<br>
<br>
in this project i have two user <br>
1- first <br>
  user: admin@test.com <br>
  pass: admin123 <br>
  role: admin <br>
2- second <br>
  user: user@test.com <br>
  pass: user123 <br>
  role: user <br>
<br>
<br>
  if you want create new custom user with User role, you can type follow url: <br>
    /register  <br>
    
