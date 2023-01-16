<?php

namespace App\Http\Controllers\Api;

use App\Repositories\Photo\PhotoRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostPhotosRequest;

class PhotoController extends Controller
{
    private $PhotoRepository;
    public function __construct(PhotoRepository $PhotoRepository)
    {
        $this->PhotoRepository = $PhotoRepository;
    }

    public function getAll()
    {
        return $this->PhotoRepository->getAll();
    }

    public function create(PostPhotosRequest $request)
    {
        return $this->PhotoRepository->create($request);
    }

    public function detail($id)
    {
        return $this->PhotoRepository->detail($id);
    }

    public function update(Request $request, $id)
    {
        return $this->PhotoRepository->update($request, $id);
    }

    public function delete($id)
    {
        return $this->PhotoRepository->delete($id);
    }

    public function like($id)
    {
        return $this->PhotoRepository->like($id);
    }

    public function unlike($id)
    {
        return $this->PhotoRepository->unlike($id);
    }
}
