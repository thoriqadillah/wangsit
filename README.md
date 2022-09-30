# WANGSIT KBMSI

## Prerequisite
- Node js v16.16.0
- PHP v8
## Getting Started
```
clone https://github.com/thoriqadillah/wangsit.git
cd wangsit
composer install
php artisan key:generate
npm i
```
## Collab
buat branch baru ```git checkout -b dev/nama```

ngoding seperti biasa, terus:
```
git add .
git commit -m "<message>"
git pull origin main
git push -u origin <branch baru>
```
kalo branch baru sudah ada di github, langsung aja ```git push```
## Run Local Server
```
npm run dev 
php artisan serve
```