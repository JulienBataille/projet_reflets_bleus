<?php
namespace App\Service;

use App\Repository\CategoriesRepository;

class CategoryColorService
{
    private CategoriesRepository $categoriesRepository;

    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getColorsForCategory(string $categoryName): array
    {
        $categories = $this->categoriesRepository->findAll();
        $defaultColors = [
            'iconLight' => '#41AED1',
            'iconDark' => '#0E3F78',
        ];

        foreach ($categories as $category) {
            if ($category->getName() === $categoryName) {
                return [
                    'iconLight' => $category->getIconLight() ?? $defaultColors['iconLight'],
                    'iconDark' => $category->getIconDark() ?? $defaultColors['iconDark'],
                ];
            }
        }

        return $defaultColors;
    }
}
