# WANGSIT KBMSI

## Prerequisite
- Node js LTS
- NPM
- PHP v8.1
- Composer
## Getting Started
```
git clone https://github.com/thoriqadillah/wangsit.git
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
Secara arsitektural, projek ini mengadopsi [Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html) dengan beberapa penyesuaian. Penyesuaiannya itu diambil berdasarkan kompleksitas projek dari Wangsit itu sendiri. Karena Wangsit itu projek yang cukup simpel, karena pada dasarnya ya cuma CRUD biasa. Paling yang agak kompleks di bagian pembuatan formnya. Well, lebih tepatnya projek kita mengadopsi [Service Pattern](https://medium.com/@mhdnauvalazhar/design-pattern-implementasi-service-layer-di-laravel-cea01f64f57e) sih. Nah, penyesuaiannya itu kaya gini:

- Web disini adalah client. Bisa kita aliaskan sebagai user yang menggunakan aplikasi kita
- Pada bagian `controller`, seperti projek laravel pada umumnya, berguna sebagai layer yang bertugas `menangkap request` dari user dan `meredirect user`
- Pada bagian `service`/`usecase`, adalah tempat sebagai logic dari aplikasi dan sekaligus tempat melakukan query database. Jika kalian sudah pernah ngambil DPSI pasti kalian tau `usecase` kan? Intinya, usecase adalah apa saja yang bisa dilakukan oleh suatu entitas (kalo di kuliah aktor) dalam aplikasi. Nah entitasnya itu adalah entitas yang ada di database (tabelnya).`Usecase` ini di projek-projek yang lain bisa juga disebut `service`. Nah inti dari `service` ini tu adalah CRUD dari entitas tersebut ditambah dengan kapabilitas yang mungkin bisa dia miliki. Tapi kalo misal gak ada salah satu dari CRUD nya ya jangan dipaksain. Contoh konkrit ada di `Services/EventFormServices.php`
- Untuk entity itu di projek ini gak ada, karena di laravel udah ada `Model`, jadi kita gak perlu pake entity lagi.

Kalo kalian kepo sama clean architecture itu kaya gimana, bisa cek [video ini](https://www.youtube.com/watch?v=ykBMKfe84qM&t=4069s). Meskipun pake bahasa pemrograman lain, tapi inti implementasinya sama. Jadi, untuk backend secara general yang perlu diperhatikan itu folder `Controllers`, `Livewire`, `Services`, `Models`, `database`, dan `tests/Feature`. Banyak magic dari eloquent (yang kalian pake buat query DB di laravel) terjadi di `Models`, jadi kalian wajib banget pelajari dan pahami folder tersebut.

## Livewire?
Livewire ini digunakan untuk membuat website interaktif (yang apa apa bisa dilakukan via frontend tanpa refresh), tapi bisa dilakuin pake php, bukan javascript. Nah, livewire disini digunakan untuk membuat dynamic form, karena setiap event bisa aja punya requirement yang beda beda buat pendaftaran, misalnya pendaftaran STARSHIP form yang harus diisi jumlah dan tipenya akan berbeda dengan BIMA SAKTI. Dynamic form ini biasanya dibuat pake framework frontend kalo gampangnya. Tapi kalo mau masang framework kaya `react`/`vue`/`svelte` cuma buat 1 2 halaman doang nanti jadinya overkill. Apalagi framework `react`/`vue`/`svelte` itu framework untuk membuat Single Page Application. Alasan kenapa tidak menggunakan framework js pada projek wangsit:
- SPA itu loading websitenya cuma sekali di awal. Artinya user perlu mendownload seluruh website sebelum bisa make (bukan per page seperti website pada umumnya). Karena Wangsit ini cukup simpel, jadi overkill juga kalo ngeharusin user ngedownload semua websitenya
- SPA itu digunakan buat aplikasi yang interaksi usernya cukup rumit, contohnya figma, canva, gdocs, dll. Kalo WANGSIT mah gak sampe kaya gitu, cuma beberapa halaman doang yang butuh halaman dinamis
- Sebenernya bisa bisa aja masang vue buat 1 2 halaman (vue bisa diinstall pake cdn kaya bootstrap, jadi bisa dipasang buat halaman spesifik), tapi cuma bakal nambah kompleksitas doang nantinya (nambahin bahasa baru ke dalam projek). Ditambah lagi nanti juga perlu nyimpen data ke database, nanti harus nembak dari vue ke database pake API, dan kompleksitas-kompleksitas lainnya
- Bisa aja pake JQuery buat dinamis form, tapi tidak direkomendasikan menggunakan JQuery pada tahun 2022, udah gak jaman, apalagi JQuery udah ditinggalin sama pengembangnya, udah gak dimaintenance.

Alasan menggunakan livewire:
- Pada dasarnya livewire itu kaya laravel biasa, pake bahasa php, syntaxnya pun sama, jadi laravel developer kaya kita bisa lumayan cepet buat adaptasi.
- Livewire memungkinkan membuat website yang interaktif tadi menggunakan PHP, baik dari frontend dan backendnya. Jadi semua orang harusnya bisa cepet adaptasi ke framework ini. Dan kita bisa nentuin halaman mana saja yang perlu dibuat dinamis. Contoh di projek WANGSIT ini adalah di `event` dan `academy`, dan `event-registration` pada user dan `event-form` dan `root` pada admin. Bisa dilihat perubahan data dilakukan tanpa merefresh website.

## Penjelasan DB
Secara general kalian bisa liat design dari database wangsit ini disini. Tabel-tabel ini gak make foreign key karena ternyata pas development awal malah jadi ribet, makanya gak pake foreign key. Tapi tetep bisa direlasikan kok, tenang. Mungkin dari tabel-tabel nya biasa aja kecuali bagian event dan kawan-kawannya, karena rada beda design nya.

`events`

Tempat dimana menyimpan data event

`event_forms`

Tempat dimana menyimpan format form dari setiap event. Nah data format formnya itu dalam bentuk json kalo di db nya. Nah, setelah diquery akan di casting menjadi assoc array dengan format kaya gini secara default:
```php
[
  'form_type' => `Text` | `Textarea`, | `Checkbox` | `Radio` | `Dropdown`
  'judul' => string,
  'placeholder' => string,
  'required' => boolean,
  'options' => [
  	[
  		'text' => string,
  		'value' => string
  	]
]
```
dimana `form_type` untuk sekarang ini ada `Text`, `Textarea`, `Checkbox`, `Radio`, dan `Dropdown`. Nah format ini bakal digunain buat merender form-form input yang dibutuhkan.

Tanda `|` maksudnya itu adalah pilihan antara berbagai tipe data yang ada. Required dipake buat validasinya. `options` ini dipake buat jadi pilihan buat tipe form selain `text` dan `textarea`

`event_form_responses`

Kalo kalian pernah bikin gform, maka penamaan data responden akan dinamai response, makanya dalam db kita juga kaya gitu. Hampir sama kaya `event_forms`, `event_form_responses` bakal dipake buat nyimpen response dari user dalam bentuk json juga kalo di db, dan di casting ke dalam assoc array. Intinya json dipake kalo data yang disimpen itu dinamis. Ya meskipun bisa banget disimpen dalam bentuk versi normalized (per data dijadiin masing-masing kolom). Tapi kalo kaya gitu nanti ketika bikin formnya harus ngedit input satu-satu, dalam artian, ketika kita ingin ngedit input kedua, kita harus bikin route sendiri untuk ngedit input tersebut, kemudian save. Sedangkan yang ada saat ini kita bener-bener dinamis, ngeditnya 1 form, bukan per input. Paham gak ni wkwkw. Pahami aja ya. Nantinya response user akan berbentuk kaya gini di db:
```php
[
  'judul' => string,
  'required' => boolean,
  'response' => [] | string
]
```
Tanda `|` maksudnya itu adalah pilihan antara berbagai tipe data yang ada. Required dipake buat validasinya. Sedangkan response punya 2 tipe response, string dan array. Array ini dipake ketika tipe inputnya adalah checkbox, karena checkbox ini bisa menampung lebih dari satu pilihan, sedangkan sisanya string biasa.

`event_lulus_statuses`

Ini dipake untuk ngetrack siapa aja yang lulus pada masing-masing peserta event kalo event tersebut ada sistem kelulusannya. Karena kalo misal ada kelulusan, selain data user disimpen di `event_form_responses`, dia bakal disimpen langsung di `event_lulus_statuses` dengan status dia tidak lulus secara default. Nantinya admin harus memutuskan untuk meluluskan atau tidaknya masing-masing peserta.

## Debugging
Manfaatkan debugging dengan cara merubah `APP_DEBUG` di env menjadi true untuk development. Kalo untuk production diset false aja biar ngilangin debugbar yang ada di bawah itu

## Improvements
### Backend
#### **Authentication**
Pada awal pembuatan, metode web scraping dipake buat registrasi akun jika belum punya akun di db. Nah, web scraping ini pada dasarnya ngambil data dari website lain, dalam kasus WANGSIT adalah SIAM. Jadi misal ada user pertama kali masuk WANGSIT dia belum punya akun, nanti nim dan passwordnya akan digunakan untuk login SIAM dan ngambil data diri yang ada di SIAM (tentu saja hal ini tidak boleh disalahgunakan). Ketika datanya sudah didapat, maka akan disimpan di db. Setelah itu akan login selanjutnya akan langsung ngambil dari db. Permasalhannya, hal ini bisa jadi bottleneck, karena untuk scraping datanya butuh waktu 3 detik (lama), dan bayangkan jika ada banyak orang sekaligus melakukan hal ini, maka akan jadi beban server. Nah untuk improvementnya, kalian bisa pakai API google account. Nah, hal yang patut diperhatikan, mungkin aja nanti dalam hal login bisa aja pake email, bukan nim, nanti tinggal disesuaikan aja, mungkin kalo bisa dibuat bisa login pake dua duanya
#### **Refactoring**
Refactoring disini berguna untuk membuat projek secara keseluruhan lebih maintanable dan lebih enak dibaca, biar nanti periode-periode selanjutnya gak kesusahan buat mahami project, dan kalian bisa enak ngasih penjelasan karena projeknya sendiri mudah adipahami, dari segi penamaan variabel, function, dan file, serta struktur foldernya. Contoh refactor bisa liat di video dari [Laracast](https://www.youtube.com/watch?v=c2YJ6GmahJk), atau beberapa video dari [Laravel Daily](https://www.youtube.com/results?search_query=laravel+refactoring)
#### **Email system**
Kalian bisa banget pake email system buat ngasih pengumuman ke pengguna. Kelebihannya tentu saja dia otomatis dan bisa dijadwal, bisa dikasih template email per event, dll. 
### Frontend
#### **Responsif**
Beberapa halaman di admin ada yang tidak responsif, karena pada waktu pengembangan sudah mepet dan cukup rumit dan stressful untuk dikerjakan pada waktu yang mepet
#### **Refactoring**
Masih ada bagian dari frontend yang kurang modular, sehingga bisa ngebuat website nya kurang maintainable dan konsisten dari segi frontend ke depannya. Contohnya, seharusnya pada bagian `@yield('content')` itu bisa dimasukkan ke dalam div, jadinya view yang jadi `content` tersebut gausah ngasih container `<div class="px-20 py-20"></div>` setiap kali nge extend layouts. Bisa kalian liat setiap view harus ditaro dalam div tersebut, dan jatuhnya malah kita kurang efisien dan ngulang-ngulang kodingan kita. Konsistensi juga ada dampak lebih ke kemudahan kita untuk ngoding ke depannya. Contoh lagi, semisal `@yield('content')` ditaro di dalam div, dan kita ingin nambahin `flash message`, maka kita cukup buat view `flash message` terus kita `@include` di atasnya `@yield('content')`, sesederhana itu, bukan diulang-ulang include di berbagai file. Selebihnya kalian coba cari bagian mana aja yang bisa kalian refactoring agar kodingannya lebih scalable kedepannya. 
#### **Desain**
Lagi-lagi karena keterbatasan waktu pengembangan, jadinya desainnya juga seadanya. Maka dari itu, buat WANGSIT jadi website yang eye catching kaya website KBMSI yang lainnya dari segi desain

## Possible bug
- Semisal kalo bikin event, awalnya ada kelulusan, terus udah ada yang daftar, terus adminnya kebetulan mencla mencle ngganti jadi gak ada kelulusan, kemudian ada user mendaftar event tersebut ketika gaada sistem kelulusan. Sampe sini gak masalah seharusnya, karena checkbox untuk menyatakan kelulusannya itu gak ditampilin kalo gaada kelulusan. Nah, masalahnya bakal muncul kalo adminnya mencla mencle kalo dia ngganti lagi jadi ada kelulusan, kemudian ada user yang mendaftar lagi di event tersebut ketika diganti lagi jadi ada kelulusan. Nah itu nanti bisa aja bakal miss penempatan checkbox nya, dan mungkin juga error, khususnya pas ngeset lulus nggaknya peserta tersebut, karena data di event_lulus_statuses dia gak kerekam kan yang pas daftar di kelulusannya gak ada. Dan juga pengumuman di user bakal ngebug harusnya