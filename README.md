# Simple Finance App

## 📌 About
Simple Finance App built with Laravel & Vue js with Inertia js

## 🛠️ Technologies
- **Laravel**
- **Inertia.js**
- **Vue.js**
- **Tailwind CSS**
- **Shadcn-Vue**

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
    transactions: Array
  },
  methods: {
    sort(field) {
      this.$inertia.get(this.route('transactions.index'), { sort_field: field });
    }
  }
};
</script>
```

## 📄 Lisensi
Proyek ini menggunakan lisensi **MIT**.

