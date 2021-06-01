<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Storage;

class AdminModel extends Model
{
    public $timestamps = false;
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    protected $table = '';
    protected $folderUpload = '';
    protected $fieldSearchAccepted = [
        'id',
        'name'
    ];
    protected $crudNotAccepted = [
        '_token',
        'thumb_current'
    ];

    public function uploadThumb($thumbObj){
        $thumbName = Str::random(10) . '.' . $thumbObj->clientExtension(); // random newNameImage
        $thumbObj->storeAs($this->folderUpload, $thumbName, 'zvn_storage_image'); // ( nơi lưu trữ image sau khi upload, newNameFile )

        return $thumbName;
    }

    public function deleteThumb($thumbName) {
        Storage::disk('zvn_storage_image')->delete($this->folderUpload . '/' . $thumbName);
    }

    public function prepareParams($params) {
        return array_diff_key($params, array_flip($this->crudNotAccepted));
    }
}
