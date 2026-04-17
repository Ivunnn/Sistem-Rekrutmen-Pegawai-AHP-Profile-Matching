# Sistem Pendukung Keputusan Rekrutmen Karyawan Menggunakan Metode AHP dan Profile Matching
Sistem Pendukung Keputusan Rekrutmen Karyawan Menggunakan Metode AHP dan Profile Matching pada PT Mutiara Putri Gemilang


## Installation
1. git clone
2. cd projectName
3. composer install
4. npm install
5. edit file .env to fit your environment such your DatabaseName
6. edit file .env to activate contact us feature
MAIL_MAILER=smtp
MAIL_ADMIN=herdiantoivan45@gmail.com
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=91926a4f6e3823
MAIL_PASSWORD=16f389a4433bf1
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=herdiantoivan45@gmail.com
MAIL_FROM_NAME="PT Mutiara Putri Gemilang"
7. php artisan key:generate
8. Create an empty database for our application
9. In the .env file, add database information to allow Laravel to connect to the database
10. php artisan migrate
11. php artisan db:seed
12. php artisan serve

login <br>
email: admin@gmail.com <br>
pass : 123456


