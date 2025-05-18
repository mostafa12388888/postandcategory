<?php
namespace App\Repository\Frontend;

use App\Models\Image;
use App\Repository\MainRepository;



class ImageRepository extends MainRepository
{


    /**
     * model
     *
     * @return string
     */
    public function model(): string
    {
        return Image::class;
    }


}
