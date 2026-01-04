# How to Make Changes and See Them on Your Website

## Quick Reference

### ✅ Changes That Reflect Immediately (No Extra Steps)

1. **Blade View Files** (`.blade.php`)
   - Edit files in `resources/views/sneakers/`
   - Refresh browser - changes appear instantly
   - Files: `index.blade.php`, `show.blade.php`

2. **PHP Controller Logic**
   - Edit `app/Http/Controllers/SneakerController.php`
   - Refresh browser - changes appear instantly

3. **Routes**
   - Edit `routes/web.php`
   - Refresh browser - changes appear instantly

---

### ⚠️ Changes That Require Extra Steps

#### 1. **CSS/JavaScript Changes**

**If you edit:**
- `resources/css/app.css`
- `resources/js/app.js`
- Any CSS in view files (inline styles)

**You must rebuild:**
```bash
npm run build
```

**OR for development (auto-rebuild on changes):**
```bash
npm run dev
```
Keep this running in a separate terminal - it watches for changes and rebuilds automatically.

---

#### 2. **Database Changes**

**If you:**
- Add new fields to models
- Change migration files
- Modify seeder data

**Steps:**

1. **Edit the migration file** (if adding fields)
2. **Run migration:**
   ```bash
   php artisan migrate:fresh
   ```
   ⚠️ **Warning:** This deletes all data!

3. **Reseed the database:**
   ```bash
   php artisan db:seed --class=SneakerSeeder
   ```

**OR if you just want to update existing data:**
```bash
php artisan tinker
```
Then in tinker:
```php
$sneaker = App\Models\Sneaker::find(1);
$sneaker->name = "New Name";
$sneaker->save();
```

---

#### 3. **Clear Cache (If Changes Don't Appear)**

Sometimes Laravel caches views/routes. Clear cache:

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

**Or clear everything at once:**
```bash
php artisan optimize:clear
```

---

## Step-by-Step: Common Changes

### Change Sneaker Images

1. **Edit `database/seeders/SneakerSeeder.php`**
   ```php
   'image_path' => 'https://your-new-image-url.com/image.jpg',
   ```

2. **Reseed database:**
   ```bash
   php artisan migrate:fresh
   php artisan db:seed --class=SneakerSeeder
   ```

3. **Refresh browser** - New images appear!

---

### Change Sneaker Prices/Names

**Method 1: Edit Seeder (Recommended)**
1. Edit `database/seeders/SneakerSeeder.php`
2. Change price/name values
3. Run: `php artisan migrate:fresh && php artisan db:seed --class=SneakerSeeder`

**Method 2: Edit Database Directly**
```bash
php artisan tinker
```
```php
$sneaker = App\Models\Sneaker::where('name', 'Air Max 90')->first();
$sneaker->price = 150.00;
$sneaker->save();
```

---

### Change Website Colors/Styling

1. **Edit view files:**
   - `resources/views/sneakers/index.blade.php`
   - `resources/views/sneakers/show.blade.php`

2. **Find the `<style>` section** and change colors:
   ```css
   .sneaker-price {
       color: #f53003; /* Change this color */
   }
   ```

3. **If you edited CSS files** (`resources/css/app.css`):
   ```bash
   npm run build
   ```

4. **Refresh browser** - Changes appear!

---

### Add New Sneakers

1. **Edit `database/seeders/SneakerSeeder.php`**
   ```php
   $sneakers = [
       // ... existing sneakers ...
       [
           'name' => 'New Sneaker',
           'brand' => 'Nike',
           'model' => 'Air',
           'price' => 120.00,
           'description' => 'Description here',
           'image_path' => 'https://image-url.com/image.jpg',
       ],
   ];
   ```

2. **Reseed:**
   ```bash
   php artisan migrate:fresh
   php artisan db:seed --class=SneakerSeeder
   ```

3. **Refresh browser** - New sneaker appears!

---

### Change Page Layout

1. **Edit `resources/views/sneakers/index.blade.php`**
   - Modify the grid layout CSS
   - Change card structure
   - Adjust spacing

2. **Refresh browser** - Layout changes appear!

---

## Development Workflow

### Recommended Setup (2 Terminals)

**Terminal 1: PHP Server**
```bash
php artisan serve --port=9000
```

**Terminal 2: Asset Watcher (for CSS/JS changes)**
```bash
npm run dev
```

This way:
- ✅ View changes = Just refresh browser
- ✅ CSS/JS changes = Auto-rebuilds, just refresh browser
- ✅ Database changes = Run migration/seeder commands

---

## Troubleshooting

### Changes Not Showing?

1. **Hard refresh browser:**
   - Windows: `Ctrl + F5`
   - Mac: `Cmd + Shift + R`

2. **Clear Laravel cache:**
   ```bash
   php artisan optimize:clear
   ```

3. **Rebuild assets:**
   ```bash
   npm run build
   ```

4. **Check if server is running:**
   ```bash
   php artisan serve --port=9000
   ```

5. **Check browser console** for errors (F12)

---

## File Locations for Common Changes

| What to Change | File Location |
|---------------|---------------|
| Sneaker listing page | `resources/views/sneakers/index.blade.php` |
| Sneaker detail page | `resources/views/sneakers/show.blade.php` |
| Sneaker data | `database/seeders/SneakerSeeder.php` |
| Page logic | `app/Http/Controllers/SneakerController.php` |
| Routes/URLs | `routes/web.php` |
| CSS styles | `resources/css/app.css` OR inline in view files |
| Database structure | `database/migrations/` |

---

## Quick Commands Cheat Sheet

```bash
# Start server
php artisan serve --port=9000

# Rebuild assets (after CSS/JS changes)
npm run build

# Watch assets (auto-rebuild on changes)
npm run dev

# Clear all cache
php artisan optimize:clear

# Reset database and reseed
php artisan migrate:fresh
php artisan db:seed --class=SneakerSeeder

# Open database editor
php artisan tinker
```

---

## Summary

**Instant Changes (Just Refresh Browser):**
- ✅ Blade view files
- ✅ Controller code
- ✅ Routes
- ✅ Inline CSS in views

**Requires Rebuild:**
- ⚠️ CSS/JS files → `npm run build` or `npm run dev`

**Requires Database Reset:**
- ⚠️ Seeder changes → `php artisan migrate:fresh && php artisan db:seed --class=SneakerSeeder`
- ⚠️ Migration changes → `php artisan migrate:fresh`

**If Changes Don't Show:**
- 🔄 Hard refresh browser (Ctrl+F5)
- 🔄 Clear cache: `php artisan optimize:clear`

