<?php

namespace People\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyHoliday extends Model
{
    public function company() {
        return $this->belongsTo('People\Models\Company');
    }
}
