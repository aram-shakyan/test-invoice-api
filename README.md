# Test Invoice API

## Project setup
- composer install
- copy .env.example to .env
- configure .env file DB, APP URL etc..
- php artisan key:generate
- php artisan migrate --seed
- php artisan passport:install


## Project Seed users
- Admin user: admin@test.com / secret 
- Member user: member@test.com / secret

## Project User Permissions

1. Admin
      - create invoice
      - update invoice
      - delete invoice
      - view invoices
      - view invoice
      
2. Member
    - view invoices
    - view invoice
    - pay invoice
    - view payed history
