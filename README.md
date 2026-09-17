# 🚀 TaskFlow API

TaskFlow-API is a professional RESTful API built with **Laravel 11**, following **Domain-Driven Design (DDD)** principles. It's designed to manage tasks efficiently, featuring UUIDs for security, a clean architecture, and a high-quality interactive documentation via **Scalar**.

## 🛠️ Tech Stack

- **Framework:** Laravel 11
- **Language:** PHP 8.4
- **Architecture:** Domain-Driven Design (DDD)
- **Database:** SQLite (Local development)
- **Authentication:** Laravel Sanctum (Bearer Tokens)
- **Documentation:** Scramble & Scalar UI
- **Primary Keys:** UUIDs

## 🔑 Demo Credentials (For Testing)

If you want to test the API, use the following demonstration account:

- **Email:** `demo@gmail.com`
- **Password:** `password123`

**How to test:**
1. Make a `POST` request to `/api/login` with the credentials above.
2. Copy the `access_token` from the response.
3. Use the token in the header of all other requests:
   `Authorization: Bearer {your_token}`

## 🚀 Getting Started

### Prerequisites
- PHP 8.4+
- Composer

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/EnzoYuri1/TaskFlow-API.git
   cd TaskFlow-API
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Set up the environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Run migrations and seed the demo user:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

5. Start the server:
   ```bash
   php artisan serve
   ```

## 📖 API Endpoints

### Authentication
- `POST /api/login` - Authenticate and receive a token.
- `POST /api/logout` - Invalidate current token.

### Tasks (Protected)
- `GET /api/tasks` - List all tasks.
- `POST /api/tasks` - Create a new task.
- `GET /api/tasks/{id}` - Get task details.
- `PUT /api/tasks/{id}` - Update a task.
- `DELETE /api/tasks/{id}` - Remove a task.
- `PATCH /api/tasks/{id}/complete` - Mark task as completed.

## 🏗️ Architecture

This project uses a **DDD (Domain-Driven Design)** approach to ensure scalability and maintainability:
- `app/Domains/Tasks/...` - All business logic, models, and services related to the Tasks domain.
- `app/Http/Requests/...` - Centralized input validation.
- `app/Domains/Tasks/Resources/...` - JSON transformation layer.

---
Developed by [Enzo Yuri](https://github.com/EnzoYuri1)
