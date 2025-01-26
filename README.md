## Linux Ubuntu 24.04 deploy
### git repo
```Shell
cd /var/www/
git clone https://github.com/anton-chernets/google-sheets-parser.git
cd google-sheets-parser
cp .env.example .env
```
### Preparing for sail virtual
```Shell
sudo apt update
sudo apt-get install composer
composer install
./vendor/bin/sail up #Docker is not running.
apt install wsl
wsl --list -v
sudo apt update
sudo apt install curl apt-transport-https ca-certificates software-properties-common
sudo apt install docker.io -y
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /usr/share/keyrings/docker-archive-keyring.gpg
sudo apt update
sudo apt install docker-ce -y
sudo apt install docker-compose
```
### Sail virtual start
```Shell
./vendor/bin/sail up #project started
php artisan google-sheets-parser:command #start parsing to DB

```
### Public ip address
```Shell
138.201.190.167
```
### Additional commands
``` Shell
docker compose down -v
sail build --no-cache
sail up
sail stop
```

## Project Used PHP Google Client:
[google-api-php-client](https://github.com/googleapis/google-api-php-client/)

## Google Docs Spreadsheet:
[Google Sheets](https://developers.google.com/sheets/api/reference/rest?apix=true&hl=en)

# Instructions for Creating a Service Account and JSON File for Google Sheets API

This guide will help you create a service account, configure access to the Google Sheets API, and download the key in JSON format.

## Steps

### 1. Access Google Cloud Console
- Go to [Google Cloud Console](https://console.cloud.google.com/).

### 2. Select a Project
- Select your existing project or create a new one.

### 3. Go to "Credentials"
- In the left sidebar, navigate to **"APIs & Services" > "[Credentials](https://console.cloud.google.com/apis/credentials?hl=en)"**.

### 4. Create a Service Account
1. Click the **"Create Credentials"** button.
2. Select **"Service account"**.
3. Enter a name for the service account (e.g., `google-sheets-service-account`).
4. Click **"Create and Continue"**.

### 5. Assign Roles
- Assign a role to the service account:
   - **"Viewer"** (read-only access).
- Click **"Continue"**.

### 6. Create a Key
1. After creating the service account, go to the list of service accounts:
   - Find your account in the list.
   - Click on the name of the service account.
2. Go to the **"Keys"** tab.
3. Click **"Add Key"** > **"Create new key"**.
4. Select the **JSON** format.
5. Click **"Create"**.

### 7. Download the JSON File
- The key will automatically download to your computer.
- Save the file in your project directory at: `app/storage/app/credentials`.

### 8. Grant Access to the Service Account
- Open your Google Sheet.
- Click Share in the top right corner.
- Add the email address from the service account JSON file (look for the client_email key in the JSON file).
- Give the service account at least Viewer or Editor permissions depending on your needs.
