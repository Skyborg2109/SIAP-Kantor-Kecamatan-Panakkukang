# AGENTS.md

## Project Overview

SIAP Panakkukang — Laravel 13.17 queue & information system for Kecamatan Panakkukang public service. Livewire for UI, Laravel Reverb for WebSocket, Laravel Breeze for auth, Tailwind CSS for styling.

## Fresh Installation

```bash
# 1. Copy .env.example to .env
cp .env.example .env

# 2. Edit .env — set DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 3. Create MySQL database
# mysql -u root -e "CREATE DATABASE siap_panakkukang"

# 4. Run setup
composer setup

# 5. Start dev server
composer dev
```

**Requirements:** PHP 8.3+, Composer, Node.js 18+, MySQL 8+

## Quick Commands

### Development
```bash
composer setup          # Install deps, generate key, migrate, npm install, build
composer dev            # Start dev server (php artisan dev)
npm run dev             # Start Vite dev server
```

### Testing
```bash
composer test           # Clear config cache + run all tests
php artisan test --compact                           # Run all tests
php artisan test --compact --filter=TestName         # Run specific test
vendor/bin/phpunit tests/Feature/SomeTest.php        # Run specific file
```

### Code Quality
```bash
vendor/bin/pint --dirty --format agent   # Format modified PHP files
php artisan route:list                    # Inspect routes
```

### Create Files
```bash
php artisan make:model ModelName --all    # Model + migration + factory + seeder
php artisan make:test TestName --phpunit  # Feature test
php artisan make:test TestName --phpunit --unit  # Unit test
```

## Architecture

### Key Directories
- `app/Livewire/` — Livewire components (AdminDashboard, PetugasDashboard, PublicDisplay)
- `app/Models/` — Eloquent models (User, Counter, Service, Queue, Information, Announcement)
- `app/Services/` — Business logic (QueueService)
- `app/Events/` — Broadcast events (QueueCalled, QueueCompleted)
- `app/View/Components/` — Blade view components
- `app/Http/Requests/` — Form request validation
- `resources/views/livewire/` — Blade templates for Livewire components (NOT `resources/views/blade/`)
- `routes/web.php` — Route definitions

### Role-Based Routing
- `/` → redirects to `/dashboard`
- `/dashboard` → redirects based on `auth()->user()->role` (ADMIN → admin.dashboard, PETUGAS → petugas.dashboard)
- `/display` — Public display for monitors (no auth required)
- `/admin` — Admin dashboard (auth + ADMIN role)
- `/petugas` — Officer dashboard (auth + PETUGAS role)

### Real-Time System
- Laravel Reverb handles WebSocket connections
- Events broadcast on `public-display` channel: QueueCalled, QueueCompleted
- PublicDisplay Livewire component listens via `#[On('echo:public-display,...')]` attributes
- Polling fallback (`checkQueueUpdate`) ensures updates if Reverb drops

### Database
- **Production**: MySQL (configured in `.env`)
- **Testing**: SQLite in-memory (configured in `phpunit.xml`, `DB_CONNECTION=sqlite`)
- Queue numbers reset daily (prefix + sequential: A-001, B-001, etc.)

### Queue Status Flow
```
WAITING → CALLED → SERVING → COMPLETED
                  ↘ SKIPPED
```

### Boost Integration
- Laravel Boost installed with skills: infer-conventions, laravel-best-practices, testing-best-practices, tailwindcss-development
- `CLAUDE.md` contains Boost bootstrap instructions

## Development Notes

### Testing
- Tests use SQLite in-memory database (no setup required)
- Factories exist for all models — use them in tests
- Run narrow test sets: `php artisan test --compact --filter=TestName`

### Code Style
- Laravel Pint for PHP formatting — run after modifying PHP files
- Follow existing code conventions (check sibling files)
- Use PHP 8 constructor property promotion
- Use TitleCase for Enum keys

### Frontend
- Blade templates with Livewire components
- Tailwind CSS for styling
- Run `npm run build` or `composer dev` if frontend changes don't appear

### Important Patterns
- Livewire components use `#[Layout('layouts.app')]` attribute (PublicDisplay uses `#[Layout('layouts.display')]`)
- Events dispatched for real-time updates to display
- Role-based access control in middleware and routes
- QueueService handles business logic for queue operations (callNextQueue, recallQueue, completeQueue, skipQueue + batch variants)

## Verification

After making changes:
1. Run `vendor/bin/pint --dirty --format agent` (if PHP files modified)
2. Run `composer test` to verify all tests pass
3. Check route changes with `php artisan route:list`
