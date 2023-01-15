<?php

namespace App\Repositories\Photo;

use LaravelEasyRepository\Repository;

interface PhotoRepository extends Repository{

    public function getAll();
    public function create($request);
    public function detail($id);
    public function update($request, $id);
    public function delete($id);
    public function like($id);
    public function unlike($id);

}
