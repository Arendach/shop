<?php

namespace App\Http\Controllers\Bridge;

use Illuminate\Http\Request;
use App\Library\BaseConnection;

class UsersSyncController extends BridgeController
{
    public function section_main(BaseConnection $connection)
    {
        $users = $connection->requestParse('user', 'all_users');

        dd($users);
    }
}
