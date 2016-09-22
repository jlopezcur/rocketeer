<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VaultMeta extends Model {

    protected $table = 'vault_metas';
    protected $fillable = ['key', 'value', 'comment', 'vault_id'];

    public function parent() {
        return $this->belongsTo('App\Vault');
    }

}
