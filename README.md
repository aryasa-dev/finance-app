# Simple Finance App

<div align="center">
  <div>
    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Laravel</title><path d="M23.642 5.43a.364.364 0 01.014.1v5.149c0 .135-.073.26-.189.326l-4.323 2.49v4.934a.378.378 0 01-.188.326L9.93 23.949a.316.316 0 01-.066.027c-.008.002-.016.008-.024.01a.348.348 0 01-.192 0c-.011-.002-.02-.008-.03-.012-.02-.008-.042-.014-.062-.025L.533 18.755a.376.376 0 01-.189-.326V2.974c0-.033.005-.066.014-.098.003-.012.01-.02.014-.032a.369.369 0 01.023-.058c.004-.013.015-.022.023-.033l.033-.045c.012-.01.025-.018.037-.027.014-.012.027-.024.041-.034H.53L5.043.05a.375.375 0 01.375 0L9.93 2.647h.002c.015.01.027.021.04.033l.038.027c.013.014.02.03.033.045.008.011.02.021.025.033.01.02.017.038.024.058.003.011.01.021.013.032.01.031.014.064.014.098v9.652l3.76-2.164V5.527c0-.033.004-.066.013-.098.003-.01.01-.02.013-.032a.487.487 0 01.024-.059c.007-.012.018-.02.025-.033.012-.015.021-.03.033-.043.012-.012.025-.02.037-.028.014-.01.026-.023.041-.032h.001l4.513-2.598a.375.375 0 01.375 0l4.513 2.598c.016.01.027.021.042.031.012.01.025.018.036.028.013.014.022.03.034.044.008.012.019.021.024.033.011.02.018.04.024.06.006.01.012.021.015.032zm-.74 5.032V6.179l-1.578.908-2.182 1.256v4.283zm-4.51 7.75v-4.287l-2.147 1.225-6.126 3.498v4.325zM1.093 3.624v14.588l8.273 4.761v-4.325l-4.322-2.445-.002-.003H5.04c-.014-.01-.025-.021-.04-.031-.011-.01-.024-.018-.035-.027l-.001-.002c-.013-.012-.021-.025-.031-.04-.01-.011-.021-.022-.028-.036h-.002c-.008-.014-.013-.031-.02-.047-.006-.016-.014-.027-.018-.043a.49.49 0 01-.008-.057c-.002-.014-.006-.027-.006-.041V5.789l-2.18-1.257zM5.23.81L1.47 2.974l3.76 2.164 3.758-2.164zm1.956 13.505l2.182-1.256V3.624l-1.58.91-2.182 1.255v9.435zm11.581-10.95l-3.76 2.163 3.76 2.163 3.759-2.164zm-.376 4.978L16.21 7.087 14.63 6.18v4.283l2.182 1.256 1.58.908zm-8.65 9.654l5.514-3.148 2.756-1.572-3.757-2.163-4.323 2.489-3.941 2.27z"/></svg>
    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Vue.js</title><path d="M24,1.61H14.06L12,5.16,9.94,1.61H0L12,22.39ZM12,14.08,5.16,2.23H9.59L12,6.41l2.41-4.18h4.43Z"/></svg>
    <!-- <img src="https://img.shields.io/badge/-Expo-black?style=for-the-badge&logoColor=white&logo=expo&color=000020" alt="Expo" />
    <img src="https://img.shields.io/badge/-TypeScript-black?style=for-the-badge&logoColor=white&logo=typescript&color=3178C6" alt="TypeScript" />
    <img src="https://img.shields.io/badge/-Tailwind_CSS-black?style=for-the-badge&logoColor=white&logo=tailwindcss&color=06B6D4" alt="Tailwind CSS" />
    <img src="https://img.shields.io/badge/-Appwrite-black?style=for-the-badge&logoColor=white&logo=appwrite&color=F02E65" alt="Appwrite" /> -->
  </div>

  <h3 align="center">Simple Finance App</h3>

  <div align="center">
    Build this project step by step with our detailed tutorial on <a href="https://www.youtube.com/@javascriptmastery/videos" target="_blank"><b>JavaScript Mastery</b></a> YouTube. Join the JSM family!
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
