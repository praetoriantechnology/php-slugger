docker build -t slugger-tester .
docker run -v "${PWD}:/var/www/html" slugger-tester /usr/local/bin/composer test