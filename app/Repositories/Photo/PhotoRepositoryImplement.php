<?php

namespace App\Repositories\Photo;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Photo;
use App\Models\Like;
use App\Models\PhotoDetails;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Facades\Auth;

class PhotoRepositoryImplement extends Eloquent implements PhotoRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Photo $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        $query  = $this->model->with(['detail', 'likes'])->where('status', 1)->get();

        if ($query->isEmpty()) {
            return BaseController::error(NULL, "Data tidak ditemukan", 400);
        }

        return BaseController::success($query, "Berhasil menarik data blog", 200);
    }

    public function create($request)
    {

        try {
            $imageName = time() . '.' . $request->image->extension();
            Storage::disk('public')->putFileAs('image', $request->file('image'), $imageName);

            $url = "http://127.0.0.1:8000/uploads/image/" . $imageName;

            DB::beginTransaction();

            $input = new $this->model();
            $input->user_id = Auth::user()->id;
            $input->path = $url;
            $input->status = 1;
            $input->save();
            $input->id;

            $detail  = new PhotoDetails();
            $detail->photo_id =  $input->id;
            $detail->caption = $request->caption;
            $detail->tags = $request->tags;
            $detail->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return BaseController::error(NULL, $e->getMessage(), 400);
        }
        return BaseController::success($input, "Sukses menambah data", 200);
    }

    public function detail($id)
    {
        $query  = $this->model->with(['detail'])->find($id);

        if ($query ==  NULL) {
            return BaseController::error(NULL, "Data tidak ditemukan", 400);
        }

        return BaseController::success($query, "Berhasil menarik data detail", 200);
    }

    public function update($request, $id)
    {
        $user = Auth::user();
        $this->model = $this->model->find($id);
        $detailPhoto = PhotoDetails::where('photo_id', '=', $id)->first();
        $detailPhoto->caption = $request->caption ??  $detailPhoto->caption;
        $detailPhoto->tags = $request->tags ??  $detailPhoto->tags;
        try {
            if ($user->id == $this->model->user_id) {
                $detailPhoto->update();
            } else {
                return BaseController::error("maaf anda bukan pemilik foto Ini");
            }
        } catch (\Exception $e) {
            return BaseController::error(NULL, $e->getMessage(), 400);
        }
        return BaseController::success($detailPhoto, "Sukses update data", 200);
    }
    public function delete($id)
    {

        try {
            DB::beginTransaction();

            $delete = Photo::where('id', $id)->update([
                "status" => 0,
            ]);

            $query = PhotoDetails::find($delete);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            return BaseController::error(NULL, $e->getMessage(), 400);
        }
        return BaseController::success($query, "Sukses hapus data", 200);
    }

    public function like($id)
    {

        try {

            DB::beginTransaction();

            $query = Photo::find($id);
            if (!empty($query)) {
                $input = new Like();
                $input->user_id = Auth::user()->id;
                $input->photo_id = $id;
                $input->save();
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return BaseController::error(NULL, $e->getMessage(), 400);
        }
        return BaseController::success($input, "Sukses like Photo", 200);
    }

    public function unlike($id)
    {
        try {

            DB::beginTransaction();

            $delete = Like::where([
                ['photo_id',  $id],
                ['user_id',  Auth::user()->id]
            ])->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return BaseController::error(NULL, $e->getMessage(), 400);
        }
        return BaseController::success($delete, "Sukses like Photo", 200);
    }
}
