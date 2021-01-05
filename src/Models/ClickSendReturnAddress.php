<?php

namespace CraftCodery\ClickSend\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Subscriber
 *
 * @property int $id
 * @property int $clicksend_id
 * @property string $hash
 *
 * @mixin \Eloquent
 */
class ClickSendReturnAddress extends Model
{
    protected $table = 'clicksend_return_addresses';
    protected $fillable = ['clicksend_id', 'hash'];
}
