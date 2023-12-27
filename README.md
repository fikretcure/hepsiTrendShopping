## Welcome Hepsi Trend Api,

- #php8.2 #composer 2.6.6 #Mysql Latest Version
- Servisleri ayni klasor icinde yapilandirmaniz, daha verimli olacaktir. ./hepsitrend/

### Step - 1 Iyzico Service
- git clone https://github.com/fikretcure/hepsiTrendIyzico.git
- cp .env.example .env
- composer install
- php artisan key:generate
- php artisan serve --port=8005


### Step - 2 Invoice Notification Service
- Create a database named ht-invoincenot
- git clone https://github.com/fikretcure/hepsiTrendInvoiceNotification.git
- cp .env.example .env
- Kullanilabilir smtp bilgileri kullanmalisiniz
- composer install
- php artisan key:generate
- php artisan migrate:fresh
- php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
- php artisan storage:link
- php artisan queue:listen
- php artisan serve --port=8006


### Step - 3 Shopping Service
- Create a database named ht-shopping
- git clone https://github.com/fikretcure/hepsiTrendShopping.git
- cp .env.example .env
- composer install
- php artisan key:generate
- php artisan migrate:fresh --seed
- php artisan storage:link
- php artisan serve --port=8007


### Step - 4 Auth Service
- Create a database named ht-auth
- git clone https://github.com/fikretcure/hepsiTrendAuth.git
- cp .env.example .env
#### Auth Service icin Ozel Not
    .env dosyasinda ki
    
    MASTER_ADMIN_EMAIL="sait@gmail.com"
    CUSTOMER_EMAIL="ahmet@gmail.com"

    Default sifre = Ht2023!
    
    keylerini degistirerek kendi mailinizle database'de kurulum yapabilirsiniz.
- composer install
- php artisan key:generate
- php artisan migrate:fresh --seed
- php artisan serve --port=8008


### Step - 5 Gateway Service
- git clone https://github.com/fikretcure/hepsiTrendGateway.git
- cp .env.example .env
- composer install
- php artisan key:generate
- php artisan serve --port=8009
