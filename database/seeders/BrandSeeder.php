<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if(!Brand::where('slug', 'akko')->exists()){
            $brands = [
                ['name' => 'Akko', 'slug' => 'akko', 'desc' => 'Akko is known for its vibrant and stylish mechanical keyboards, keycaps, and accessories. They offer a variety of pre-built and custom keyboards with unique themes, high-quality PBT keycaps, and their own line of mechanical switches.', 'image_url' => 'https://en.akkogear.com/wp-content/uploads/2020/05/cropped-Akko-logo-1-1.png'],
                ['name' => 'Keychron', 'slug' => 'keychron', 'desc' => 'Keychron specializes in wireless and wired mechanical keyboards designed for productivity and enthusiasts. They are famous for their sleek designs, Mac and Windows compatibility, hot-swappable switches, and aluminum frames.', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTk-B71UXgxpEUH8nQlFXhdUAGkTQnYy7z-pg&s'],
                ['name' => 'Gateron', 'slug' => 'gateron', 'desc' => 'Gateron is one of the leading manufacturers of mechanical keyboard switches, known for their smooth keystrokes and diverse range of options, including linear, tactile, and clicky switches. Their switches are widely used by custom keyboard builders.', 'image_url' => 'https://www.gateron.co/cdn/shop/products/Gateron-logo.jpg?v=1657008450&width=1024'],
                ['name' => 'KBDfans', 'slug' => 'kbdfans', 'desc' => 'KBDfans is a one-stop shop for mechanical keyboard enthusiasts, offering DIY kits, custom cases, PCBs, keycaps, stabilizers, and more. They cater to both beginners and advanced users looking to build high-quality custom keyboards.', 'image_url' => 'https://kbdfans.com/cdn/shop/files/1_d2e8d4f4-bf1b-4756-bb7b-1235a9b69d5a_1200x1200.png?v=1705452941'],
                ['name' => 'NovelKeys', 'slug' => 'novelkeys', 'desc' => 'NovelKeys is known for innovative switches, high-quality keycap sets, and limited-edition desk accessories. They collaborate with designers and brands to produce unique, high-end mechanical keyboard products.', 'image_url' => 'https://cdn.shopify.com/s/files/1/3099/8088/files/NovelKeys_Logo.png?height=628&pad_color=ffffff&v=1630432573&width=1200'],
                ['name' => 'GMK', 'slug' => 'gmk', 'desc' => 'GMK (Gunther Meinhardt Kunststofftechnik) is the premier manufacturer of high-end double-shot ABS keycaps, produced in Germany. Their keycaps are known for their durability, crisp legends, and premium colorways.', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp_mR2usYfWqOH7B5TCjqpQT-KBvAvGyPhwu0WIFmVsR6biHOuEhxWXuLxVRtglWtWXVM&usqp=CAU'],
                ['name' => 'Epomaker', 'slug' => 'epomaker', 'desc' => 'Epomaker creates budget-friendly mechanical keyboards with high-end features like hot-swappable PCBs, Bluetooth connectivity, and customizable RGB lighting. They focus on bringing innovation and affordability to the mechanical keyboard community.', 'image_url' => 'https://yt3.googleusercontent.com/ytc/AIdro_kN-u5F3iwIyqu2PD5Kg-08FnNT8tWlMDEVBVKluMh-TQ=s900-c-k-c0x00ffffff-no-rj'],
                ['name' => 'Wuque Studio', 'slug' => 'wuque-studio', 'desc' => 'Wuque Studio is a premium keyboard brand that designs high-quality custom keyboards, switches, and accessories. Their keyboards often feature innovative mounting styles, gasket designs, and a focus on acoustic performance.', 'image_url' => 'https://styles.redditmedia.com/t5_36ycsl/styles/profileIcon_spkam1gvyiea1.png?width=256&height=256&frame=1&auto=webp&crop=256:256,smart&s=9a15ce4fc193fb50e6b6481b84da110420a3e682'],
                ['name' => 'Ajazz', 'slug' => 'ajazz', 'desc' => 'Ajazz offers a variety of mechanical keyboards that blend affordability with great build quality. They are known for their unique designs, colorful keycaps, and their own line of mechanical switches.', 'image_url' => 'https://ajazzstore.com/cdn/shop/files/350954572_1917991488535350_2141770078765880809_n_2.jpg?v=1706671319'],
                ['name' => 'Weikav', 'slug' => 'weikav', 'desc' => 'Weikav is a rising brand in the mechanical keyboard space, known for producing custom switches and keyboard parts that enhance the typing experience with innovative designs and smooth actuation.', 'image_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSprbJQrSmLfJR9N1x8fnjQydw7eqwcIYH2Jg&s'],
                ['name' => 'Cidoo', 'slug' => 'cidoo', 'desc' => 'Cidoo manufactures high-quality mechanical keyboards with a focus on aesthetics and functionality. They offer premium designs with features like gasket-mounted structures, CNC aluminum cases, and custom switches.', 'image_url' => 'https://cidootech.com/cdn/shop/files/cidoo-header-logo_185x_2x_c8873b0d-f491-49a6-8e20-43bf82382728.png?v=1671006311'],
                ['name' => 'Cherry', 'slug' => 'cherry', 'desc' => 'Cherry is the original creator of the mechanical switch and remains an industry leader. Their Cherry MX switches are the gold standard for mechanical keyboards, offering reliability, consistency, and long-lasting performance.', 'image_url' => 'https://images.tokopedia.net/img/cache/215-square/GAnVPX/2021/3/20/58da021c-2ace-4bfe-b751-021920668953.jpg'],
            ];
        
            foreach ($brands as $brand) {
                Brand::create($brand);
            }
        }
        
    }
}
