<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Category;
use App\Models\Song;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artistNames = [
            'Minh Khang',
            'Hoang An',
            'My Linh',
            'Thanh Nam',
            'Bao Tran',
            'Ngoc Anh',
            'Khanh Vy',
            'Gia Huy',
        ];

        $categoryNames = [
            'V-Pop Ballad',
            'Lofi Viet',
            'Indie Pop Viet',
            'Chill Rap Viet',
            'Acoustic Viet',
            'EDM Viet',
        ];

        $songTitles = [
            'Dem Mua Tren Pho',
            'Cho Em Mot Lan',
            'Tinh Yeu Mau Nang',
            'Gio Mang Em Ve',
            'Nhip Tim Sai Gon',
            'Con Duong Mua Thu',
            'Cham Vao Giac Mo',
            'Mot Vong Tay Em',
            'Mua Ha Da Qua',
            'Ngay Mai Van The',
            'Nho Em Luc Dem Ve',
            'Tan Ca Nguoi Tre',
            'Tinh Ca Pho Dem',
            'Dieu Em Chua Noi',
            'Phut Ban Dau',
            'Mong Em Binh Yen',
            'Nang Len Roi',
            'Nguoi O Lai',
            'Khung Troi Moi',
            'Gui Vao Gio',
        ];

        $artists = collect($artistNames)->map(function (string $name, int $index) {
            $slug = Str::slug($name);

            return Artist::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'bio' => 'Vietnamese contemporary artist #' . ($index + 1),
                    'image_url' => 'images/artists/' . $slug . '.jpg',
                ]
            );
        })->values();

        $categories = collect($categoryNames)->map(function (string $name) {
            $slug = Str::slug($name);

            return Category::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name]
            );
        })->values();

        foreach ($songTitles as $index => $title) {
            $slug = Str::slug($title);
            $artist = $artists[$index % $artists->count()];
            $category = $categories[$index % $categories->count()];

            Song::updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'artist_id' => $artist->id,
                    'category_id' => $category->id,
                    'file_url' => 'music/song-' . str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) . '.mp3',
                    'cover_image' => 'images/covers/song-' . str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) . '.jpg',
                    'duration_seconds' => 180 + (($index % 6) * 15),
                    'is_active' => true,
                    'view_count' => 0,
                ]
            );
        }
    }
}
