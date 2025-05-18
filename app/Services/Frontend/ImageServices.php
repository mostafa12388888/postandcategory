<?php
namespace App\Services\Frontend;

use App\Helpers\FileHelper;
use App\Repository\Frontend\ImageRepository;
use App\Repository\MainRepository;
use App\Services\MainService;

 class ImageServices extends MainService {
     /**
     * @var ImageRepository
     */
    protected MainRepository $repository;

    /**
     * __construct
     *
     * @param  mixed $repository
     * @return void
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;
        parent::__construct($repository);
    }
    /**
     * storeImage
     *
     * @param  mixed $data
     * @return void
     */
    public function storeImage(array $data,$postId):mixed
    {
        $dataImage=[];
        foreach ($data as $image)
        $dataImage[] = [
            'post_id' => $postId,
            'path' => FileHelper::uploadFile($image, 'PostImage'),
        ];
        return $this->insert($dataImage);
    }
    
}
