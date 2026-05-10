# Keytify WebCommerce Mock Up

Made with Laravel, Vue 3, and InertiaJS

## Preview

### Client

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997150458449921/Screenshot_47.png?ex=6a01bead&is=6a006d2d&hm=6b4ddbac34af64596da1337215415f5ea67daf3bfac080ed288e17b41af48dbc&=&format=webp&quality=lossless)

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997151234527232/Screenshot_49.png?ex=6a01bead&is=6a006d2d&hm=af83059fed07e81a6ee99bf20c4e08a6f37d862273cecdf11d11824343fc37b4&=&format=webp&quality=lossless)

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997148298514452/Screenshot_52.png?ex=6a01beac&is=6a006d2c&hm=41b49eb9c6eaa5677d8f9577c33597327009efa8f3464810b398e33058e77a20&=&format=webp&quality=lossless)

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997149556670546/Screenshot_56.png?ex=6a01beac&is=6a006d2c&hm=da0ad5db293b9131ba145bf9233fcd7d8ce0d15333747bcc9dfe775817a494c0&=&format=webp&quality=lossless)

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997149993144381/Screenshot_57.png?ex=6a01beac&is=6a006d2c&hm=25b07f39a83047888111d97c1b5c9b40e060eb0ee39ac2134f6f4d2a7f806629&=&format=webp&quality=lossless)

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997176001757225/Screenshot_58.png?ex=6a01beb3&is=6a006d33&hm=368d5cba17cdfd0a43221ced9e3f237264cc72c67f83d5e69e28826e377ca600&=&format=webp&quality=lossless)

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997177004458105/Screenshot_61.png?ex=6a01beb3&is=6a006d33&hm=5f1f9e79a2cb0e772c596f6760714398d0eda84b053620097b74432766e71789&=&format=webp&quality=lossless)

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997177369231360/Screenshot_68.png?ex=6a01beb3&is=6a006d33&hm=5a3c3465c7820c0722da5af472098dfe82950666ef15d32f209419afd125de92&=&format=webp&quality=lossless)

### Admin Dashboard

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997174538207252/Screenshot_70.png?ex=6a01beb2&is=6a006d32&hm=beffc717b74b146d0218636eef4625d6aff8deefdfe5f65d6bdca6f2dad4a4fd&=&format=webp&quality=lossless)

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997174806511772/Screenshot_71.png?ex=6a01beb2&is=6a006d32&hm=6d5cd4816a8488e9070f1fbdac626afe15d06629f65b0655d18ebdd8a20c431d&=&format=webp&quality=lossless)

![Image](https://media.discordapp.net/attachments/667721366903980042/1502997177713033278/Screenshot_69.png?ex=6a01beb3&is=6a006d33&hm=e75c34a30a2672b1c481378f03cd00d09f5121ae8d394526dbd2b5b5dd2758cd&=&format=webp&quality=lossless)

## Development

### Clone Repository

First, clone this repository with

```sh
git clone
```

and then go to the folder with

```sh
cd keytify
```

### Copy Environment Configuration

Second, copy the `.env.example` with

```sh
cp .env.example .env
```

### Change Environment Configuration

After copying the `.env`, uncomment the db credentials and change the db connection to `mysql`. After that change to your preferred db credentials.

### Install Packages and Dependencies

After copying and configuring the database, run

```sh
npm install
```

and

```sh
composer install
```

to install npm / composer and all of the packages needed.

### Generating Key and Migrating Database

And then, run

```sh
php artisan key:generate
```

and

```sh
php artisan migrate
```

### Seeding Data

To get the demo and example datas, run

```sh
php artisan db:seed
```

to seed some datas, you can change the amount of you want in `database/seeders/DatabaseSeeder.php`

### Running App

After having everything done, you can run the app by running

```sh
npm run dev
```

and

```sh
php artisan serve
```

in a new terminal.
