<?php

namespace App\Models;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class AuditModel extends BaseModel implements AuditableContract {

    use Auditable;

}