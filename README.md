# Todo List API Documentation (Laravel)

## Persiapan
1. Clone repository ini
2. Install dependencies:
```bash
composer install
```
3. Copy .env.example ke .env dan sesuaikan konfigurasi database
4. Generate application key:
```bash
php artisan key:generate
```
5. Generate JWT secret:
```bash
php artisan jwt:secret
```
6. Jalankan migrations:
```bash
php artisan migrate
```
7. Jalankan server:
```bash
php artisan serve
```

## Testing API dengan Postman

### 1. API Login
```
POST /api/login
Content-Type: application/json

Request Body:
{
    "email": "user@example.com",
    "password": "password123"
}

Response Success (200):
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
    "token_type": "bearer",
    "expires_in": 3600
}
```

### 2. API Registrasi
```
POST /api/register
Content-Type: application/json

Request Body:
{
    "name": "User Test",
    "email": "user@example.com",
    "password": "password123"
}

Response Success (201):
{
    "message": "User successfully registered",
    "user": {
        "name": "User Test",
        "email": "user@example.com",
        "id": 1
    },
    "token": "eyJ0eXAiOiJKV1QiLCJhbGc..."
}
```

### 3. API Membuat Checklist
```
POST /api/checklists
Authorization: Bearer {token}
Content-Type: application/json

Request Body:
{
    "name": "Daily Tasks",
    "description": "Tasks for today"
}

Response Success (201):
{
    "id": 1,
    "name": "Daily Tasks",
    "description": "Tasks for today",
    "user_id": 1,
    "created_at": "2024-01-08T..."
}
```

### 4. API Menghapus Checklist
```
DELETE /api/checklists/{id}
Authorization: Bearer {token}

Response Success (204 No Content)
```

### 5. API Menampilkan Checklist
```
GET /api/checklists
Authorization: Bearer {token}

Response Success (200):
[
    {
        "id": 1,
        "name": "Daily Tasks",
        "description": "Tasks for today",
        "items": []
    }
]
```

### 6. API Detail Checklist
```
GET /api/checklists/{id}
Authorization: Bearer {token}

Response Success (200):
{
    "id": 1,
    "name": "Daily Tasks",
    "description": "Tasks for today",
    "items": [
        {
            "id": 1,
            "name": "Buy groceries",
            "is_completed": false
        }
    ]
}
```

### 7. API Membuat Item dalam Checklist
```
POST /api/checklists/{checklist_id}/items
Authorization: Bearer {token}
Content-Type: application/json

Request Body:
{
    "name": "Buy groceries"
}

Response Success (201):
{
    "id": 1,
    "checklist_id": 1,
    "name": "Buy groceries",
    "is_completed": false
}
```

### 8. API Detail Item
```
GET /api/items/{id}
Authorization: Bearer {token}

Response Success (200):
{
    "id": 1,
    "checklist_id": 1,
    "name": "Buy groceries",
    "is_completed": false
}
```

### 9. API Mengubah Item
```
PUT /api/items/{id}
Authorization: Bearer {token}
Content-Type: application/json

Request Body:
{
    "name": "Buy groceries and fruits"
}

Response Success (200):
{
    "id": 1,
    "name": "Buy groceries and fruits",
    "is_completed": false
}
```

### 10. API Mengubah Status Item
```
PATCH /api/items/{id}/status
Authorization: Bearer {token}
Content-Type: application/json

Request Body:
{
    "is_completed": true
}

Response Success (200):
{
    "id": 1,
    "name": "Buy groceries and fruits",
    "is_completed": true
}
```

### 11. API Menghapus Item
```
DELETE /api/items/{id}
Authorization: Bearer {token}

Response Success (204 No Content)
```

## Urutan Testing yang Disarankan
1. Register user baru (API #2)
2. Login dengan user yang sudah dibuat (API #1)
3. Buat checklist baru (API #3)
4. Tampilkan daftar checklist (API #5)
5. Lihat detail checklist (API #6)
6. Buat item dalam checklist (API #7)
7. Lihat detail item (API #8)
8. Ubah nama item (API #9)
9. Ubah status item (API #10)
10. Hapus item (API #11)
11. Hapus checklist (API #4)

## Catatan Penting
- Semua endpoint kecuali login dan register memerlukan token JWT
- Token harus disertakan di header sebagai Bearer token
- Response codes:
  - 200: Success
  - 201: Created
  - 204: No Content
  - 400: Bad Request
  - 401: Unauthorized
  - 404: Not Found
  - 422: Validation Error
- Validasi input dilakukan untuk memastikan data yang dimasukkan sesuai
