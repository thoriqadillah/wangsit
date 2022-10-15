# WANGSIT KBMSI

## Prerequisite
- Node js v16.16.0
- NPM
- PHP v8.1
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
## Penjelasan Project
Secara arsitektural, projek ini mengadopsi [Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html) dengan beberapa penyesuaian. Penyesuaiannya itu diambil berdasarkan kompleksitas projek dari Wangsit itu sendiri. Karena Wangsit itu projek yang cukup simpel, karena pada dasarnya ya cuma CRUD biasa. Paling yang agak kompleks di bagian pembuatan formnya. Well, lebih tepatnya projek kita mengadopsi `service pattern` sih. Nah, penyesuaiannya itu kaya gini:

- Web disini adalah client. Bisa kita aliaskan sebagai user yang menggunakan aplikasi kita
- Pada bagian `controller`, seperti projek laravel pada umumnya, berguna sebagai layer yang bertugas `menangkap request` dari user dan `meredirect user`
- Pada bagian `service`/`usecase`, adalah tempat sebagai logic dari aplikasi dan sekaligus tempat melakukan query database. Jika kalian sudah pernah ngambil DPSI pasti kalian tau `usecase` kan? Intinya, usecase adalah apa saja yang bisa dilakukan oleh suatu entitas (kalo di kuliah aktor) dalam aplikasi. Nah entitasnya itu adalah entitas yang ada di database (tabelnya).`Usecase` ini di projek-projek yang lain bisa juga disebut `service`. Nah inti dari `service` ini tu adalah CRUD dari entitas tersebut ditambah dengan kapabilitas yang mungkin bisa dia miliki. Tapi kalo misal gak ada salah satu dari CRUD nya ya jangan dipaksain. Contoh konkrit ada di `Services/EventFormServices.php`
- Untuk entity itu di projek ini gak ada, karena di laravel udah ada `Model`, jadi kita gak perlu pake entity lagi.

Kalo kalian kepo sama clean architecture itu kaya gimana, bisa cek [video ini](https://www.youtube.com/watch?v=ykBMKfe84qM&t=4069s). Meskipun pake bahasa pemrograman lain, tapi inti implementasinya sama. Jadi, untuk backend secara general yang perlu diperhatikan itu folder `Controllers`, `Livewire`, `Services`, `Models`, `database`, dan `tests/Feature`.

## Livewire?
Livewire ini digunakan untuk membuat website interaktif (yang apa apa bisa dilakukan via frontend tanpa refresh), tapi bisa dilakuin pake php, bukan javascript. Nah, livewire disini digunakan untuk membuat dynamic form, karena setiap event bisa aja punya requirement yang beda beda buat pendaftaran. Dynamic form ini biasanya dibuat pake framework kalo gampangnya. Tapi kalo mau masang framework kaya `react`/`vue`/`svelte` cuma buat 1 2 halaman doang nanti jadinya overkill. Apalagi framework `react`/`vue`/`svelte` itu framework untuk membuat Single Page Application. Alasan kenapa tidak menggunakan framework js pada projek wangsit:
- SPA itu loadingnya sekali. Artinya user perlu mendownload seluruh website sebelum bisa make (bukan per page). Karena Wangsit ini cukup simpel, jadi overkill juga kalo ngeharusin user ngedownload semua websitenya
- Sebenernya bisa bisa aja masang vue buat 1 2 halaman, tapi cuma bakal nambah kompleksitas doang nantinya (nambahin bahasa baru ke dalam projek).
- Tidak direkomendasikan menggunakan JQuery pada tahun 2022

Alasan menggunakan livewire:
- Pada dasarnya livewire itu kaya laravel biasa, pake bahasa php, syntaxnya pun sama, jadi developer baru kaya kita bisa lumayan cepet buat adaptasi.
- Livewire memungkinkan membuat website yang interaktif tadi menggunakan PHP + dari frontend dan backend. Jadi semua orang harusnya bisa cepet adaptasi ke framework ini. Jadi kita bisa pilih halaman mana saja yang butuh fitur dinamis. Contoh di projek Wangsit ini adalah di `event` dan `academy`, dan `register` pada user dan `add-form` pada admin. Bisa dilihat perubahan data dilakukan tanpa merefresh website.

## Improvements
### Backend
// TODO: list improvement di backend
### Frontend
// TODO: list improvement di frontend