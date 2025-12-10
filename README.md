# Laravel E-commerce Refactoring Project

## Project Goal
This project is designed for students to practice refactoring an existing Laravel controller - specifically the `OrderController`. The current implementation works but has several areas that can be improved for better code quality, maintainability, and performance.

## Current State
The application is a basic e-commerce platform with:
- Product listing and management
- Order creation and viewing functionality
- Test data already seeded in the database
- Working navigation between products and orders

## Refactoring Tasks for Students
- Review and improve the `OrderController` code structure
- Optimize database queries and reduce N+1 issues
- Improve validation and error handling
- Add proper service layer architecture
- Improve code readability and maintainability
- Add better error handling and user feedback
- Consider implementing proper authorization patterns
- Refactor any overly complex methods into smaller, more manageable ones

## Setup
1. Clone the repository
2. Run `composer install`
3. Set up your environment variables in `.env`
4. Run `php artisan migrate --seed` to set up the database
5. Run `php artisan serve` to start the development server

## Database Seeding
To seed the database with test data again, run:

```bash
php artisan migrate:refresh && php artisan db:seed
```

This will:
1. Clear all existing data by refreshing migrations
2. Run all seeders to populate the database with test data:
   - 4 Users
   - 18 Products (including sample electronics)
   - 10 Orders with various statuses
   - 25 Order Items linking products to orders
