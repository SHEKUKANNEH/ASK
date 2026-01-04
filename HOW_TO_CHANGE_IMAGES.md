# How to Change Images on the Front Page - Step by Step

## Method 1: Edit the Seeder File (Recommended - Easiest)

This method updates the images in the database by editing the seeder file.

### Step 1: Open the Seeder File
1. Navigate to: `database/seeders/SneakerSeeder.php`
2. Open it in your code editor

### Step 2: Find the Image URLs
Look for the `$sneakers` array. You'll see entries like this:

```php
[
    'name' => 'Air Max 90',
    'brand' => 'Nike',
    'model' => 'Air Max',
    'price' => 120.00,
    'description' => 'The Nike Air Max 90...',
    'image_path' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=800&h=800&fit=crop',
],
```

### Step 3: Change the Image URL
Replace the `image_path` value with your new image URL:

**Option A: Use an online image URL**
```php
'image_path' => 'https://your-image-url.com/sneaker.jpg',
```

**Option B: Use a local image**
1. Create folder: `public/images/sneakers/`
2. Put your image there (e.g., `airmax90.jpg`)
3. Update the path:
```php
'image_path' => '/images/sneakers/airmax90.jpg',
```

### Step 4: Save the File
Press `Ctrl + S` to save the file

### Step 5: Reset and Reseed the Database
Open your terminal and run:

```bash
php artisan migrate:fresh
php artisan db:seed --class=SneakerSeeder
```

⚠️ **Warning:** This will delete all existing data and recreate it with your new images.

### Step 6: Refresh Your Browser
- Go to your website: `http://localhost:9000`
- Press `Ctrl + F5` (hard refresh) to see the new images

---

## Method 2: Update Database Directly (Without Resetting)

This method updates images for existing sneakers without deleting data.

### Step 1: Open Laravel Tinker
In your terminal, run:
```bash
php artisan tinker
```

### Step 2: Find the Sneaker
```php
$sneaker = App\Models\Sneaker::find(1);
```
(Replace `1` with the ID of the sneaker you want to change)

### Step 3: Update the Image
```php
$sneaker->image_path = 'https://your-new-image-url.com/image.jpg';
$sneaker->save();
```

### Step 4: Exit Tinker
```php
exit
```

### Step 5: Refresh Browser
Go to your website and press `Ctrl + F5`

---

## Method 3: Use Local Images (Best for Production)

### Step 1: Create Images Folder
In your terminal:
```bash
mkdir public\images\sneakers
```

### Step 2: Add Your Images
1. Copy your sneaker images
2. Paste them into: `public/images/sneakers/`
3. Name them clearly (e.g., `nike-airmax-90.jpg`)

### Step 3: Update Seeder File
Edit `database/seeders/SneakerSeeder.php`:

```php
[
    'name' => 'Air Max 90',
    'brand' => 'Nike',
    'model' => 'Air Max',
    'price' => 120.00,
    'description' => 'The Nike Air Max 90...',
    'image_path' => '/images/sneakers/nike-airmax-90.jpg', // Local path
],
```

### Step 4: Reset Database
```bash
php artisan migrate:fresh
php artisan db:seed --class=SneakerSeeder
```

### Step 5: Refresh Browser
Visit your website and refresh

---

## Complete Example: Changing All 5 Sneaker Images

### Step 1: Prepare Your Images
- Find 5 sneaker images online or use your own
- Note their URLs or save them locally

### Step 2: Edit `database/seeders/SneakerSeeder.php`

Replace the entire `$sneakers` array with your images:

```php
$sneakers = [
    [
        'name' => 'Air Max 90',
        'brand' => 'Nike',
        'model' => 'Air Max',
        'price' => 120.00,
        'description' => 'The Nike Air Max 90 stays true to its OG running roots...',
        'image_path' => 'https://example.com/airmax90.jpg', // YOUR IMAGE URL
    ],
    [
        'name' => 'Classic Leather',
        'brand' => 'Reebok',
        'model' => 'Classic',
        'price' => 75.00,
        'description' => 'The Reebok Classic Leather sneaker...',
        'image_path' => 'https://example.com/reebok.jpg', // YOUR IMAGE URL
    ],
    [
        'name' => 'Superstar',
        'brand' => 'Adidas',
        'model' => 'Superstar',
        'price' => 80.00,
        'description' => 'The Adidas Superstar is one of the most iconic...',
        'image_path' => 'https://example.com/superstar.jpg', // YOUR IMAGE URL
    ],
    [
        'name' => 'Air Force 1',
        'brand' => 'Nike',
        'model' => 'Air Force',
        'price' => 90.00,
        'description' => 'The radiance lives on in the Nike Air Force 1...',
        'image_path' => 'https://example.com/airforce1.jpg', // YOUR IMAGE URL
    ],
    [
        'name' => 'Chuck Taylor All Star',
        'brand' => 'Converse',
        'model' => 'Chuck Taylor',
        'price' => 55.00,
        'description' => 'The Converse Chuck Taylor All Star...',
        'image_path' => 'https://example.com/converse.jpg', // YOUR IMAGE URL
    ],
];
```

### Step 3: Save the File
Press `Ctrl + S`

### Step 4: Run Commands
```bash
php artisan migrate:fresh
php artisan db:seed --class=SneakerSeeder
```

### Step 5: View Your Changes
- Open browser: `http://localhost:9000`
- Press `Ctrl + F5` to hard refresh
- See your new images!

---

## Where to Find Free Sneaker Images

1. **Unsplash** - https://unsplash.com/s/photos/sneakers
2. **Pexels** - https://www.pexels.com/search/sneakers/
3. **Pixabay** - https://pixabay.com/images/search/sneakers/

**To use Unsplash images:**
1. Go to Unsplash
2. Search for "sneakers"
3. Click on an image
4. Click "Download" or copy the image URL
5. Use the URL in your seeder file

---

## Troubleshooting

### Images Not Showing?

1. **Check the URL is correct**
   - Make sure the URL starts with `http://` or `https://`
   - Test the URL in your browser first

2. **For local images:**
   - Make sure images are in `public/images/sneakers/`
   - Path should start with `/images/sneakers/` (not `public/`)

3. **Clear browser cache:**
   ```bash
   php artisan view:clear
   ```
   Then hard refresh: `Ctrl + F5`

4. **Check file permissions:**
   - Make sure images folder is readable

### Image Size Recommendations

- **Width:** 800-1200 pixels
- **Height:** 800-1200 pixels
- **Format:** JPG or PNG
- **File size:** Under 500KB (for faster loading)

---

## Quick Reference Commands

```bash
# Reset database and reseed with new images
php artisan migrate:fresh
php artisan db:seed --class=SneakerSeeder

# Update single image via tinker
php artisan tinker
# Then: $sneaker = App\Models\Sneaker::find(1);
# Then: $sneaker->image_path = 'new-url';
# Then: $sneaker->save();
# Then: exit

# Clear cache
php artisan view:clear
```

---

## Summary

**Easiest Method:**
1. Edit `database/seeders/SneakerSeeder.php`
2. Change `image_path` values
3. Run: `php artisan migrate:fresh && php artisan db:seed --class=SneakerSeeder`
4. Refresh browser

**File Location:** `database/seeders/SneakerSeeder.php`

**Key Field:** `'image_path' => 'your-image-url-here'`

