# Laravel Blog API

## Objective

The objective of this assignment is to build a RESTful API using the Laravel Framework to manage a multi-user, multi-category blog system. This assignment focuses on your ability to handle Eloquent Relationships, optimize queries to avoid the N+1 problem, implement Searching/Pagination, and utilize Factories and Seeders for data automation.

## Data Models & Migrations

You must generate migrations and models for the following schema:

Table Name : categories

|   Column | Type | Constraints                          |
| -----: | -------- | -------------------------------- |
| id | BigInt      | Primary Key |
| name | string  | Unique        |
| created_at | datetime      |           |
| updated_at | datetime      |           |

Table Name : posts

|   Column | Type | Constraints                          |
| -----: | -------- | -------------------------------- |
| id | BigInt      | Primary Key |
| user_id | BigInt  | Foreign Key        |
| category_id | BigInt  | Foreign Key        |
| title | string  |         |
| body | string  |         |
| post_image | string  | Nullable / File Path        |
| created_at | datetime      |           |
| updated_at | datetime      |           |

[!NOTE] For the User model, you may use the default Laravel migration.

## Factories & Database Seeding

To facilitate testing, you must implement the following:

- Factories:
    - Create a CategoryFactory to generate unique category names.
    - Create a PostFactory to generate dummy titles, bodies, and assign random user_id and category_id values.
- Database Seeder:
    - Configure DatabaseSeeder.php to generate:
        - 10 Users (using Laravel's default User factory).
        - 5 Categories.
        - 50 Posts distributed across those users and categories.

## Implementation Requirements

A. Routing & Controllers
- Create a Resource Controller (PostController) and define the following API routes:
    - GET /api/posts (index) — Must include Eager Loading, Searching, and Pagination.
    - POST /api/posts (store) 
    - GET /api/posts/{id} (show) — Retrieve post with author and category details.
    - PUT/PATCH /api/posts/{id} (update).
    - DELETE /api/posts/{id} (destroy).

B. N+1 Problem Optimization
- When listing posts, you must use Eager Loading to ensure that author and category information is retrieved in a single optimized query.

C. Searching & Pagination
- Searching: Implement a filter to search by title, body, or the Category Name (e.g., /api/posts?search=technology).
- Pagination: Use Laravel's pagination to return results in chunks (e.g., 10 or 15 posts per page).

## Request Validation

You must use a Form Request class to validate the data.
- Validation Rules:
    - title: required|string|max:255.
    - body: required|string.
    - category_id: required|exists:categories,id.
    - user_id: required|exists:users,id.
    - post_image: nullable|string.

## API Response Format

- All responses must be returned in JSON format.
    - Success: Return data with a 200 OK or 201 Created status.
    - Validation Failure: Return a 422 Unprocessable Entity status with detailed error messages.

## Deliverables
- A working Laravel project.
- Database Migration, Factory, and Seeder files.
- The User, Category, and Post Models with defined relationships.
- The Controllers implementation.
- A Bruno Collection to test the API.

#
#

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

