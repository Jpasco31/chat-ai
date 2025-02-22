# Chat AI

## Overview

**Chat AI** is a simple ChatGPT-like application that uses a custom LLM model named **GPT-4o-mini**. This is a *
*full-stack** project built with **Laravel**, **Breeze**, **Vue.js**, **Inertia**, **Tailwind CSS**, and uses **SQLite**
for local data storage.

Below are the instructions to install and run the application in your local environment.

---

## Prerequisites

1. **PHP** (tested on version 8.0.30)
2. **Composer**
3. **Node.js** & **NPM** (for running the front-end build)
4. **Mailpit** (or another local mail testing tool)

> **Note**:
> - SQLite is the default database for this project; no additional DB setup is necessary.
> - If you prefer a different database, update your `.env` accordingly (not covered here).

---

## Installation

1. **Clone the Repository**  
   Ensure you have the project files in a local directory.

2. **Navigate to the Project Directory**
   ```bash
   cd chat-ai
    ``` 
3. **Install PHP Dependencies**
   ```bash
   composer install
    ```
4. **Install JavaScript Dependencies**
   ```bash
   npm install
    ``` 
5. **Environment Configuration**

    - Copy the example environment file:
       ```bash
       cp .env.example .env
      ```
    - Adjust any necessary variables in the `.end` file (e.g., app name, mail settings, etc.).

6. **Generate Application Key**

   Create a unique application key for encryption and security:

   ```bash
   php artisan key:generate
   ```
7. **Database Setup**

   Create the database in your DBMS, then run migrations to set up the necessary tables:

   ```bash
   php artisan migrate
   ```
7. **OpenAI API key to chat with an AI**

   Place your OpenAI API key in the .env file

   ```bash
   OPENAI_API_KEY=sk-proj-...
   ```

> **Note**: By default, SQLite is configured in `config/database`.php—you typically only need to ensure
`DB_CONNECTION=sqlite` in your `.end` if you wish to use SQLite.

## Running the Application

You have two main options for running the application:

### Option 1: Two-Terminal Approach

1. **Terminal 1:**   Start the Laravel development server
    ```bash
   php artishan serve
    ``` 
2. **Terminal 2:** Start the front-end build process
   ```bash
   npm run dev
    ``` 
3. **Access the application at**

   http://127.0.0.1:8000 or http://localhost:8000

### Option 2:  Single-Terminal Approach

1. **Terminal 1:**   Start the Laravel development server and front-end build process
    ```bash
   composer run dev
    ``` 

2. **Access the application at**

   http://127.0.0.1:8000 or http://localhost:8000

# Mail Server Setup

## Overview

Configure Mailpit, a local email testing tool, for the Fitness AI API server to capture and inspect outgoing emails
during development.

## Prerequisites

- **Mailpit (latest version)**
  -**Installation Methods:**
    - Docker
    - Homebrew (macOS)
    - Direct Binary Download

## Installation

### Using Docker:

```bash
docker run -d -p 1025:1025 -p 8025:8025 mailpit/mailpit
```

- SMTP: localhost:1025
- Web Interface: http://localhost:8025

### Using Homebrew (macOS)

```bash
brew install mailpit
mailpit
```

### Direct Binary Download:

Download from [Mailpit](https://mailpit.axllent.org/docs/install/) Releases, extract, and add to your PATH.

## Configuration

1. Navigate to the API Directory

```bash
cd api-server
```

2. Update .env File

```bash
MAIL_MAILER=smtp
MAIL_HOST=127.0.0.1
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="chatai@mail.com"
MAIL_FROM_NAME="ChatAI"
```

## Running Mailpit

- **Docker:**

```bash
docker run -d -p 1025:1025 -p 8025:8025 mailpit/mailpit
```

- **Homebrew:**

```bash
mailpit
```

## Testing

To verify that the application is functioning as expected, execute the test suite:

```bash
php artisan test
```
