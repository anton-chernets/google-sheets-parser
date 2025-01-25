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
