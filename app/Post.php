<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = true;

    public $post;
    public $messages;
    public $images;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address',
        'city',
        'province',
        'zip',
        'bedrooms',
        'sqfeet',
        'price',
        'description'
    ];

    public static $rules = [
        'user_id'     => 'required',
        'address'     => 'required|min:2|max:120',
        'city'        => 'required|min:2|max:120',
        'province'    => 'required|min:2|max:120',
        'zip'         => 'required|min:6|max:6',
        'bedrooms'    => 'required|max:50|integer',
        'sqfeet'      => 'required|max:500000|integer',
        'price'       => 'required|integer',
        'description' => 'required|min:2|max:1000',
    ];

    public function isValid() {
        $v = Validator::make(array_merge($this->attributes, array('post' => $this->post)), static::$rules);

        if (!$v->passes()) {
            $this->messages = $v->messages();

            return false;
        }

        // Validate images
        $file_count = count($this->images);
        // Max 3 images per posting
        if ($file_count > 3) {
            return Redirect::to('post/create')->withInput()->withErrors("You can only upload a maximum of 3 photos.");
        }

        $uploadcount = 0;
        foreach($this->images as $image) {
            $rules = array('file' => 'required|mimes:jpeg|max:5000');
            $validator = Validator::make(array('file'=> $image), $rules);
            if($validator->passes()){
                $uploadcount ++;
            }
        }

        if ($uploadcount == $file_count) {
            return true;
        } else {
            $this->messages = $validator->messages();

            return false;
        }
    }

    public function finalize($post_id) {
        foreach($this->images as $image_temp) {
            $image = new Image();

            $destinationPath = 'uploads';
            $filename = md5(time() . chr(rand(64, 90))) . '.' . $image_temp->getClientOriginalExtension();
            $upload_success = $image_temp->move($destinationPath, $filename);

            $image->post_id  = $post_id;
            $image->filename = $filename;

            $thumbnail_filename = $this->createThumbnail($filename);

            $image->thumbnail_filename = $thumbnail_filename;

            $image->save();
        }
    }

    private function createThumbnail($filename) {
        $path = public_path() . '/uploads/';

        // Create the thumbnail
        if ($im = imagecreatefromjpeg($path . $filename)) {
            $original_x = imagesx($im);
            $original_y = imagesy($im);
            $new_x = 0;
            $new_y = 0;

            if ($original_x > $original_y) {
                $new_x = 300;
                $new_y = round(300 * $original_y / $original_x);
            } else {
                $new_y = 300;
                $new_x = round(300 * $original_x / $original_y);
            }

            $thumbnail = imagecreatetruecolor($new_x, $new_y);

            imagecopyresampled($thumbnail, $im,
                               0, 0,             0,0,
                               $new_x, $new_y, $original_x, $original_y);

            $new_filename = md5($filename) . '.jpg';
            imagejpeg($thumbnail, $path . $new_filename);

            imagedestroy($im);
        } else {
            return false;
        }

        return $new_filename;
    }
}
