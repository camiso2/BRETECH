<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Log;
use App\Custom\StatusController;
use DateTime;
use App\Collection;
use App\Custom\RandomName;
use Carbon\Carbon;

class Producto extends Model
{
    protected $table = "productos";
    protected $fillable = [
        "SKU",
        "nombre",
        "descripcion",
        "foto",
        "precio",
        "IVA",
    ];


     /**
     * simulates delete product
     *
     * @param $request
     */
    public function DeletedProduct($request)
    {
        $data = Producto::where('id', $request->id)->update(['deleted_at' => Carbon::now()]);
        if($data){
            $response = StatusController::successfulMessage(200, 'Successfully created', true, 0, $data);
        }else{
            $response = StatusController::notFoundMessage();
        }
        return $response;

    }
      /**
     * Get all data products
     *
     * @param $query
     */
    public function scopeListProductAll($query)
    {
        $query->orderBy('id', 'DESC');
    }

    /**
     * create data product
     *
     * @param Collection $request
     * @param String $destinationPath
     * @param String $file_name
     * @param $file
     * @return Array
     */
    public function CreatedProduct( $request, String $destinationPath,  $file):Array
    {
        $file_name =  $this->identifyImage() . RandomName::randomName(15) . '.' . $file->getClientOriginalExtension();
        if (!file_exists($destinationPath)) {
            if (!mkdir($destinationPath, 0777, true)) {
                $response = StatusController::notFoundMessage();
            }
        }
        if (! $this->saveImage($file, $destinationPath, $file_name)) {
            $response = StatusController::notFoundMessage();
        }
        $register = new Producto();
        $register->nombre      = $request->nombre;
        $register->descripcion = $request->descripcion;
        $register->precio      = $request->precio;
        $register->IVA         = $request->IVA;
        $status                = $register->save();
        if ($status) {
            $register       = Producto::latest('id')->first();
            $register->foto = $destinationPath . $file_name;
            $register->SKU  = "00" . $register->id;
            $status         = $register->save();
            if ($status) {
                $response = StatusController::successfulMessage(200, 'Successfully created', true, 0, $register);
            } else {
                $response = StatusController::notFoundMessage();
            }
        }
        return $response;
    }
    /**
     * save and redimention image in folder
     *
     * @param String $file
     * @param String $destinationPath
     * @param String $file_name
     * @return Boolean
     */
    public function saveImage(String $file, String $destinationPath, String $file_name): bool
    {
        try {
            $image = Image::make($file);
            $image->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->orientate();
            $image->save($destinationPath . $file_name);
            if ($image) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            Log::info("Error save img :: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get Number invoice client
     * @param String $id
     * @return String
     */
    public function identifyImage(): String
    {
        $identifyImage = "";
        $current = new \DateTime();
        $identifyImage = $current->format('YmdHis');
        return $identifyImage;
    }
}
