# pfizer-bootcamp-backend

### init

```bash
composer install
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate
```

### misc

```bash
./vendor/bin/sail artisan migrate:fresh --seed
./vendor/bin/sail artisan db:seed --class=ProductsSeeder
```
