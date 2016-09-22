<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vault extends \Baum\Node {

	protected $table = 'vaults';
    protected $fillable = ['name', 'web', 'description', 'project_id'];

	// Relations

	public function pairs() {
        return $this->hasMany('App\VaultMeta');
    }

	public function project() {
        return $this->belongsTo('App\Project');
    }

}
