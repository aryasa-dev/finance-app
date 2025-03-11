# Simple Finance App

<div align="center">
  <div>
    <img src="https://img.shields.io/badge/-Laravel-black?style=for-the-badge&logoColor=white&logo=laravel&color=000020" alt="Laravel" />
    <img src="https://img.shields.io/badge/-Inertia-black?style=for-the-badge&logoColor=white&logo=inertia&color=3178C6" alt="Inertia" />
    <img src="https://img.shields.io/badge/-Vue-black?style=for-the-badge&logoColor=white&logo=vuedotjs&color=3178C6" alt="Vue" />
    <img src="https://img.shields.io/badge/-Tailwind_CSS-black?style=for-the-badge&logoColor=white&logo=tailwindcss&color=06B6D4" alt="Tailwind CSS" />
    <img src="https://img.shields.io/badge/-Shadcnui-black?style=for-the-badge&logoColor=white&logo=shadcnui&color=F02E65" alt="Shadcnui" />
  </div>

  <h3 align="center">Simple Finance App</h3>

  <div align="center">
    Build with <b>Laravel</b> & <b>Vue js</b> with <b>Inertia js</b>
  </div>
</div>

## 📌 About

Simple Finance App built with Laravel & Vue js with Inertia js

## 🛠️ Technologies

-   **Laravel**
-   **Inertia.js**
-   **Vue.js**
-   **Tailwind CSS**
-   **Shadcn-Vue**

## 🔧 Instalasi

1. **Clone repository ini**

    ```sh
    git clone https://github.com/username/repository.git
    cd repository
    ```

2. **Instal dependensi Laravel**

    ```sh
    composer install
    ```

3. **Instal dependensi frontend**

    ```sh
    npm install
    ```

4. **Buat file `.env` dan konfigurasikan database**

    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

    Sesuaikan pengaturan database di file `.env`.

5. **Jalankan migrasi database**

    ```sh
    php artisan migrate --seed
    ```

6. **Jalankan server Laravel**

    ```sh
    php artisan serve
    ```

7. **Jalankan Vite untuk frontend**
    ```sh
    npm run dev
    ```

## 🚀 Fitur

✅ **Autentikasi pengguna** (Laravel Breeze dengan Inertia.js)  
✅ **CRUD data transaksi**  
✅ **Sorting & Pagination dengan Inertia.js**  
✅ **Flash messages setelah aksi sukses/gagal**

## 📌 Contoh Routing di Laravel

```php
use Inertia\Inertia;
use App\Http\Controllers\TransactionController;

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
```

## 📌 Contoh Komponen Vue.js dengan Inertia

```vue
<template>
    <div>
        <h1 class="text-xl font-bold">Daftar Transaksi</h1>
        <table>
            <thead>
                <tr>
                    <th @click="sort('transaction_date')">Tanggal</th>
                    <th @click="sort('amount')">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="transaction in transactions" :key="transaction.id">
                    <td>{{ transaction.transaction_date }}</td>
                    <td>{{ transaction.amount }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        transactions: Array,
    },
    methods: {
        sort(field) {
            this.$inertia.get(this.route("transactions.index"), {
                sort_field: field,
            });
        },
    },
};
</script>
```

## 📄 Lisensi

Proyek ini menggunakan lisensi **MIT**.
