<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Uuids;

class UserConnection extends Model {
    use Uuids;

    /**
    * Indicates if the IDs are auto-incrementing.
    *
    * @var bool
    */
    public $incrementing = false;

    /**
    * Get the User for the oAuth Connection
    *
    */

    public function user() {
        return $this->belongsTo( 'App\Models\User' );
    }
}
