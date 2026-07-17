# 🍬 CrunchPop Candy — Field & Pantry

A bright, fully responsive, dynamic candy e-commerce website built with **Laravel 13 + MySQL + Tailwind CSS v4**.

CrunchPop Candy is the fun front door to **Field & Pantry LLC** — a South Florida food business building toward
shelf-stable food and practical hurricane preparedness.

---

## ✨ What's included

### Public site (5 pages, mobile-first)
| Page | Route | Notes |
|------|-------|-------|
| Home / Mission | `/` | All 7 sections: hero, mission strip, why-candy, product preview, F&P connection, events, final CTA |
| Shop Candy | `/shop` | Product grid, multi-pack bundles, product-info block, add-to-cart |
| Product detail | `/shop/{slug}` | Big image, quantity stepper, ingredients & allergens |
| Custom Orders / Events | `/custom-orders` | Who-it's-for grid, 3-step process, full custom-order form |
| About the Mission | `/mission` | Field & Pantry story, pillars, values |
| Contact | `/contact` | Contact form + info cards |

Plus a session **cart** (`/cart`), **checkout** (`/checkout`) that saves real orders (no live payment — early version),
and the **"Be First to Know" early-list signup** embedded across the site.

### Dynamic features
- 🛒 Session cart with quantity steppers, flat/free shipping logic
- 📦 Checkout saves orders + line items to the database
- 📝 Custom-order, contact, and early-list forms → saved to DB **and** emailed to the owner
- 📧 Styled HTML email notifications (order confirmation to customer + owner alerts)
- 🔐 **Admin panel** at `/admin` (see below)

### Admin panel (`/admin`)
Login-protected dashboard to manage everything dynamically:
- **Dashboard** — stats, recent orders / requests / signups
- **Products** — full CRUD (image upload or URL, pricing, badges, bundles, coming-soon, stock, featured)
- **Orders** — list, filter by status, view detail, update status
- **Custom Orders** — list, filter, view detail, update status, reply
- **Early List** — view signups, interests, **CSV export**
- **Messages** — contact inbox with read/unread

---

## 🚀 Running the project

Requirements: PHP 8.3+, Composer, Node 18+, MySQL (XAMPP works).

```bash
# 1. Install dependencies (already done)
composer install
npm install

# 2. Ensure MySQL is running and the `crunchpop` database exists
#    (.env is already configured: DB_DATABASE=crunchpop, root / no password)

# 3. Migrate + seed (already done — re-run to reset)
php artisan migrate:fresh --seed

# 4. Build front-end assets
npm run build       # production
# or
npm run dev         # hot-reload during development

# 5. Serve
php artisan serve
# → http://127.0.0.1:8000
```

## 🔑 Admin login

```
URL:      http://127.0.0.1:8000/admin
Email:    admin@crunchpop.test
Password: password
```
> Change this in `database/seeders/DatabaseSeeder.php` or via the DB before going live.

## 📧 Email notifications

By default `MAIL_MAILER=log` — notification emails are written to `storage/logs/laravel.log` so you can see them
without an SMTP server. To send real email, set SMTP credentials in `.env` and change `MAIL_MAILER=smtp`.
Owner notifications go to `MAIL_ADMIN_ADDRESS` (in `.env`).

## 🗄️ Database schema

`categories`, `products`, `orders`, `order_items`, `custom_order_requests`,
`early_list_signups`, `contact_messages`, and `users` (with `is_admin`).

## 🎨 Design

- Tailwind CSS v4 with a custom candy palette (berry, grape, tangerine, lime, skypop)
- Baloo 2 (display) + Nunito (body) fonts
- Rounded cards, colorful accents, big product imagery, responsive at every breakpoint
- Product images use colorful gradient placeholders until you upload real photos in the admin panel

## 📁 Adding real product photos

Log into the admin panel → **Products** → edit a product → upload an image (stored in `storage/app/public/products`,
served via the `public/storage` symlink) or paste an image URL.
