# Tech Spot Challenge

Install Instrunctions:

1.- Clone repo https://github.com/pedrosantanac/spot2-challenge.git

    git clone https://github.com/pedrosantanac/spot2-challenge.git

2.- Install dependencies

    composer install
    
3.- Run migrations
    
    php artisan migrate --seed
     
    
4.- Curl Api

    curl --location --request GET 'http://{server}/price-m2/zip-codes/1420/aggregate/max?construction_type=4'
  
