    <?php

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $categories = [
            'DVD Android|1' => [
                'OLED|1',
                'OWINCE|1',
            ],
            
        ];

        foreach ($categories as $category => $children) {
            [$categoryName, $categoryType] = explode('|', $category);

            $newCategory = ProductCategory::create([
                'title' => $categoryName,
                'type' => $categoryType,
                'slug' => Str::slug($categoryName),
                'thumbnail' => '/preview-icon.png',
                'icon' => null,
                'is_menu_top' => true,
            ]);

            foreach ($children as $child => $childrenOfChild) {
                if (is_numeric($child)) {
                    $child = $childrenOfChild;
                    $childrenOfChild = [];
                }

                [$childName, $childType] = explode('|', $child);

                $newChildCategory = $newCategory->children()->create([
                    'title' => $childName,
                    'type' => $childType,
                    'slug' => Str::slug($childName),
                    'thumbnail' => '/preview-icon.png',
                    'icon' => null,
                    'is_menu_top' => true,
                ]);

                foreach ($childrenOfChild as $childOfChild => $abcxyz) {
                    if (is_numeric($childOfChild)) {
                        $childOfChild = $abcxyz;
                        $abcxyz = [];
                    }

                    [$childOfName, $childOfType] = explode('|', $childOfChild);

                    $newChildOfCategory = $newChildCategory->children()->create([
                        'title' => $childOfName,
                        'type' => $childOfType,
                        'slug' => Str::slug($childOfName),
                        'thumbnail' => '/preview-icon.png',
                        'icon' => null,
                        'is_menu_top' => true,
                    ]);

                    foreach ($abcxyz as $abc) {
                        [$abcName, $abcType] = explode('|', $abc);

                        $newChildOfCategory->children()->create([
                            'title' => $abcName,
                            'type' => $abcType,
                            'slug' => Str::slug($abcName),
                            'thumbnail' => '/preview-icon.png',
                            'icon' => null,
                            'is_menu_top' => true,
                        ]);
                    }
                }
            }
        }
    }
}
