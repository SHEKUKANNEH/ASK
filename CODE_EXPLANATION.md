# Sneaker Website - Code Explanation Guide

This guide explains the code structure, database setup, and how to customize images and UI.

---

## 📊 Database Structure

### Models and Their Purpose

#### 1. **User Model** (`app/Models/User.php`)
**Purpose:** Represents registered users in the system.

**Key Features:**
- Handles user authentication
- Has relationship with Orders (one user can have many orders)
- Password is automatically hashed using Laravel's `hashed` cast

**Relationships:**
```php
public function orders()
{
    return $this->hasMany(Order::class);
}
```

---

#### 2. **Sneaker Model** (`app/Models/Sneaker.php`)
**Purpose:** Represents individual sneaker products.

**Fields:**
- `name` - Product name (e.g., "Air Max 90")
- `brand` - Brand name (e.g., "Nike")
- `model` - Model line (e.g., "Air Max")
- `price` - Product price (decimal)
- `description` - Product description
- `image_path` - URL or path to product image

**Relationships:**
```php
public function orders()
{
    return $this->hasMany(Order::class);
}
```

---

#### 3. **Order Model** (`app/Models/Order.php`)
**Purpose:** Represents customer purchases.

**Fields:**
- `user_id` - Foreign key to User
- `sneaker_id` - Foreign key to Sneaker
- `quantity` - Number of items ordered
- `total_price` - Total order amount
- `status` - Order status (pending, completed, cancelled)

**Relationships:**
```php
public function user()
{
    return $this->belongsTo(User::class);
}

public function sneaker()
{
    return $this->belongsTo(Sneaker::class);
}
```

---

### Database Migrations

#### **Sneakers Table** (`database/migrations/2026_01_01_152227_create_sneakers_table.php`)

**Purpose:** Creates the `sneakers` table in the database.

**Structure:**
```php
Schema::create('sneakers', function (Blueprint $table) {
    $table->id();                    // Auto-incrementing ID
    $table->string('name');          // Product name
    $table->string('brand');         // Brand name
    $table->string('model');         // Model line
    $table->decimal('price', 10, 2); // Price (10 digits, 2 decimals)
    $table->text('description')->nullable(); // Optional description
    $table->string('image_path');    // Image URL or path
    $table->timestamps();            // created_at, updated_at
});
```

**To modify:** Edit this file and run `php artisan migrate:fresh` (⚠️ This deletes all data)

---

#### **Orders Table** (`database/migrations/2026_01_01_152234_create_orders_table.php`)

**Purpose:** Creates the `orders` table with foreign key relationships.

**Structure:**
```php
Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    // Links to users table, deletes order if user is deleted
    $table->foreignId('sneaker_id')->constrained()->onDelete('cascade');
    // Links to sneakers table, deletes order if sneaker is deleted
    $table->integer('quantity')->default(1);
    $table->decimal('total_price', 10, 2);
    $table->string('status')->default('pending');
    $table->timestamps();
});
```

**Foreign Keys Explained:**
- `user_id` → Links to `users.id`
- `sneaker_id` → Links to `sneakers.id`
- `onDelete('cascade')` → If parent record is deleted, child records are automatically deleted

---

## 🎮 Controllers

### **SneakerController** (`app/Http/Controllers/SneakerController.php`)

**Purpose:** Handles all sneaker-related page requests.

**Methods:**

1. **`index()`** - Shows all sneakers
   ```php
   public function index()
   {
       $sneakers = Sneaker::all(); // Gets all sneakers from database
       return view('sneakers.index', compact('sneakers'));
       // Passes $sneakers to the view
   }
   ```

2. **`show(Sneaker $sneaker)`** - Shows single sneaker details
   ```php
   public function show(Sneaker $sneaker)
   {
       return view('sneakers.show', compact('sneaker'));
       // Laravel automatically finds sneaker by ID from URL
   }
   ```

---

## 🛣️ Routes

### **Web Routes** (`routes/web.php`)

**Purpose:** Defines URL endpoints for the application.

```php
// Homepage - shows all sneakers
Route::get('/', [SneakerController::class, 'index'])->name('home');

// Sneaker listing page
Route::get('/sneakers', [SneakerController::class, 'index'])->name('sneakers.index');

// Individual sneaker page (e.g., /sneakers/1)
Route::get('/sneakers/{sneaker}', [SneakerController::class, 'show'])->name('sneakers.show');
```

**Route Parameters:**
- `{sneaker}` - Laravel automatically finds the Sneaker model by ID
- Example: `/sneakers/1` → Finds Sneaker with ID 1

---

## 🎨 Views (User Interface)

### **Sneaker Listing Page** (`resources/views/sneakers/index.blade.php`)

**Purpose:** Displays all sneakers in a grid layout.

**Key Sections:**
1. **Header** - Navigation with login/register links
2. **Sneakers Grid** - Loop through all sneakers
3. **Sneaker Cards** - Each card shows:
   - Image
   - Brand
   - Name
   - Model
   - Price

**How it works:**
```blade
@foreach($sneakers as $sneaker)
    <a href="{{ route('sneakers.show', $sneaker) }}">
        <img src="{{ $sneaker->image_path }}" alt="{{ $sneaker->name }}">
        <div class="sneaker-brand">{{ $sneaker->brand }}</div>
        <div class="sneaker-name">{{ $sneaker->name }}</div>
        <div class="sneaker-price">${{ number_format($sneaker->price, 2) }}</div>
    </a>
@endforeach
```

---

### **Sneaker Detail Page** (`resources/views/sneakers/show.blade.php`)

**Purpose:** Shows detailed information about a single sneaker.

**Layout:**
- Left side: Large product image
- Right side: Product details (name, brand, price, description)

---

## 🖼️ How to Change Images

### **Method 1: Update Database Directly**

1. **Using Tinker (Command Line):**
   ```bash
   php artisan tinker
   ```
   Then in tinker:
   ```php
   $sneaker = App\Models\Sneaker::find(1); // Find sneaker with ID 1
   $sneaker->image_path = 'https://your-new-image-url.com/image.jpg';
   $sneaker->save();
   ```

2. **Using Database Seeder:**
   Edit `database/seeders/SneakerSeeder.php`:
   ```php
   [
       'name' => 'Air Max 90',
       'image_path' => 'https://your-new-image-url.com/airmax90.jpg',
       // ... other fields
   ],
   ```
   Then run: `php artisan db:seed --class=SneakerSeeder`

3. **Using SQLite Browser:**
   - Open `database/database.sqlite` with a SQLite browser
   - Edit the `image_path` column in the `sneakers` table

### **Method 2: Store Images Locally**

1. **Create images directory:**
   ```bash
   mkdir public/images/sneakers
   ```

2. **Upload your images** to `public/images/sneakers/`

3. **Update database** with local paths:
   ```php
   'image_path' => '/images/sneakers/airmax90.jpg'
   ```

4. **Update seeder** to use local paths:
   ```php
   'image_path' => '/images/sneakers/airmax90.jpg',
   ```

### **Method 3: Use Placeholder Images**

The views already have fallback placeholder images:
```blade
<img src="{{ $sneaker->image_path }}" 
     onerror="this.src='https://via.placeholder.com/400x300?text={{ urlencode($sneaker->name) }}'">
```

---

## 🎨 How to Customize the User Interface

### **1. Change Colors**

Edit the `<style>` section in:
- `resources/views/sneakers/index.blade.php`
- `resources/views/sneakers/show.blade.php`

**Example - Change primary color:**
```css
.sneaker-price {
    color: #f53003; /* Change this to your color */
}
```

**Example - Change background:**
```css
body {
    background-color: #FDFDFC; /* Change this */
}
```

### **2. Change Layout**

**Grid Layout (index.blade.php):**
```css
.sneakers-grid {
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    /* Change minmax(280px, 1fr) to adjust card width */
    gap: 2rem; /* Change gap between cards */
}
```

**Card Size:**
```css
.sneaker-image {
    height: 250px; /* Change image height */
}
```

### **3. Change Fonts**

In the `<head>` section, change the font import:
```html
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
```

Then update CSS:
```css
body {
    font-family: 'Your Font Name', sans-serif;
}
```

### **4. Add New Fields to Sneakers**

1. **Update Migration:**
   ```php
   // In create_sneakers_table.php
   $table->string('color')->nullable();
   $table->integer('stock')->default(0);
   ```

2. **Update Model:**
   ```php
   // In Sneaker.php
   protected $fillable = [
       'name', 'brand', 'model', 'price', 
       'description', 'image_path',
       'color', 'stock' // Add new fields
   ];
   ```

3. **Update Views:**
   ```blade
   <div class="sneaker-color">{{ $sneaker->color }}</div>
   <div class="sneaker-stock">In Stock: {{ $sneaker->stock }}</div>
   ```

4. **Run Migration:**
   ```bash
   php artisan migrate:fresh
   php artisan db:seed --class=SneakerSeeder
   ```

---

## 📝 Database Seeder

### **SneakerSeeder** (`database/seeders/SneakerSeeder.php`)

**Purpose:** Populates the database with sample sneaker data.

**How to modify:**
1. Edit the `$sneakers` array
2. Add/remove sneaker entries
3. Update image URLs, prices, descriptions

**Example - Add a new sneaker:**
```php
[
    'name' => 'Jordan 1',
    'brand' => 'Nike',
    'model' => 'Air Jordan',
    'price' => 170.00,
    'description' => 'The iconic Air Jordan 1...',
    'image_path' => 'https://example.com/jordan1.jpg',
],
```

**To reseed:**
```bash
php artisan db:seed --class=SneakerSeeder
```

⚠️ **Note:** This will add duplicate entries. To start fresh:
```bash
php artisan migrate:fresh --seed
```

---

## 🔐 Authentication

### **Login/Register Views**

Located in:
- `resources/views/livewire/auth/login.blade.php`
- `resources/views/livewire/auth/register.blade.php`

**Customization:**
- These use Flux UI components
- Styling is handled by the Flux theme
- To customize, edit the component classes

---

## 🗂️ File Structure Summary

```
sneakerapp11/
├── app/
│   ├── Http/Controllers/
│   │   └── SneakerController.php    # Handles sneaker pages
│   ├── Models/
│   │   ├── User.php                  # User model
│   │   ├── Sneaker.php               # Sneaker model
│   │   └── Order.php                 # Order model
│   └── Actions/Fortify/
│       └── CreateNewUser.php         # Registration logic
├── database/
│   ├── migrations/
│   │   ├── create_sneakers_table.php
│   │   └── create_orders_table.php
│   └── seeders/
│       └── SneakerSeeder.php        # Sample data
├── resources/views/
│   ├── sneakers/
│   │   ├── index.blade.php          # Listing page
│   │   └── show.blade.php            # Detail page
│   └── livewire/auth/                # Login/Register
└── routes/
    └── web.php                        # URL routes
```

---

## 🚀 Quick Customization Checklist

- [ ] Change images → Update `SneakerSeeder.php` or database
- [ ] Change colors → Edit CSS in view files
- [ ] Change layout → Modify grid/flexbox CSS
- [ ] Add fields → Update migration, model, views
- [ ] Change fonts → Update font import and CSS
- [ ] Modify prices → Update seeder or database

---

## 💡 Tips

1. **Always backup** before running `migrate:fresh` (deletes all data)
2. **Use `php artisan tinker`** to quickly test database changes
3. **Clear cache** if changes don't appear: `php artisan cache:clear`
4. **Rebuild assets** after CSS changes: `npm run build`

---

## 📚 Key Laravel Concepts Used

- **Eloquent Models** - Database interactions
- **Migrations** - Database schema
- **Seeders** - Sample data
- **Blade Templates** - View rendering
- **Route Model Binding** - Automatic model finding
- **Relationships** - Database connections (hasMany, belongsTo)

---

This guide covers the essential parts of your sneaker website. Modify as needed for your specific requirements!

