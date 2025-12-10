To seed the database with test data again, run:

php artisan migrate:refresh && php artisan db:seed

This will:
1. Clear all existing data by refreshing migrations
2. Run all seeders to populate the database with test data:
   - 4 Users
   - 18 Products (including sample electronics)
   - 10 Orders with various statuses
   - 25 Order Items linking products to orders