<?php
namespace App\Helpers;

use Modules\Service\Models\RayImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaHelper
{
      public static  function Image($image, $inputName, $folderName, $disk, $imageable_id, $imageable_type, $name,$type,$i)
        {
            if ($inputName === 'file') {

                        $img = $image;
                        $name = Str::slug($name);
                        $filename = $name . time() . $i . '.' . $img->getClientOriginalExtension();

                        $Image = new RayImage();
                        $Image->filename = $filename;
                        $Image->mediaable_id = $imageable_id;
                        $Image->mediaable_type = $imageable_type;
                        $Image->save();
                        $image->storeAs($folderName, $filename, $disk);
                    return 'saved';
            }
            return null;
    }

}
?>
