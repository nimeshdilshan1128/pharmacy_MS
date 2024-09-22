<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteLogoModel extends Model
{
	use HasFactory;
	protected $table = 'website_logo';

    public function getLogo()
    {
        if(!empty($this->logo) && file_exists('upload/logo/'.$this->logo))
        {
            return url('upload/logo/'.$this->logo);
        }
    }
}