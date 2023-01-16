1. nyalakan xampp
2. composer install
3. .env example rename .env
4. buat database sesuaikan dengan nama di dalam env
example:
DB_DATABASE=VhiWEB_test
DB_USERNAME=isi username
DB_PASSWORD=isi password

5. php artisan migrate:fresh --seed
6. php artisan serve
7.buka postman
8.import file di folder data postman
9. lakukan pengetesan


notes
-cek dan sesuaikan versi php terlebih dahulu
-untuk set token bisa login terlebih dahulu dan set global token nya
-token muncul di bagian response login dengan key accessToken
