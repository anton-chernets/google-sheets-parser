Project Used PHP Google client:
[google-api-php-client](https://github.com/googleapis/google-api-php-client/)

Spreadsheet google docs:
[google sheets](https://developers.google.com/sheets/api/reference/rest?apix=true&hl=en)

# Інструкція зі створення Сервісного Акаунта та JSON-файла для Google Sheets API

Ця інструкція допоможе створити сервісний акаунт, налаштувати доступ до Google Sheets API та завантажити ключ у форматі JSON.

## Кроки

### 1. Увійдіть у Google Cloud Console
- Перейдіть до [Google Cloud Console](https://console.cloud.google.com/).

### 2. Виберіть проєкт
- Виберіть ваш існуючий проєкт або створіть новий.

### 3. Перейдіть до "Credentials"
- У лівій бічній панелі оберіть **"APIs & Services" > "[Credentials](https://console.cloud.google.com/apis/credentials?hl=en)"**.

### 4. Створіть сервісний акаунт
1. Натисніть кнопку **"Create Credentials"**.
2. Виберіть **"Service account"**.
3. Введіть назву сервісного акаунта (наприклад, `google-sheets-service-account`).
4. Натисніть **"Create and Continue"**.

### 5. Призначте ролі
- Призначте сервісному акаунту роль:
- **"Viewer"** (перегляд)
- Натисніть **"Continue"**.

### 6. Створіть ключ
1. Після створення сервісного акаунта перейдіть до списку сервісних акаунтів:
    - Знайдіть свій акаунт у списку.
    - Натисніть на назву сервісного акаунта.
2. Перейдіть до вкладки **"Keys"**.
3. Натисніть **"Add Key"** > **"Create new key"**.
4. Виберіть формат **JSON**.
5. Натисніть **"Create"**.

### 7. Завантажте JSON-файл
- Ключ автоматично завантажиться на ваш комп’ютер.
- Збережіть файл у проєкті, у директорію: app/storage/app/credentials
