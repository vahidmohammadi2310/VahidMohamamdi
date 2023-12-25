for run project follow below command:

1- git clone https://github.com/vahidmohammadi2310/VahidMohamamdi.git
2- docker compose up -d
3- docker exec php_blog composer install
4- docker exec php_blog php artisan migrate --seed
5- docker exec php_blog php artisan key:generate
6- sudo chown www-data:www-data src/storage


in this project i have two user
1- first 
  user: admin@test.com
  pass: admin123
  role: admin
2- second
  user: user@test.como
  pass: user123
  role: user


  if you want create new custom user with User role, you can type follow url:
    /register 
    
