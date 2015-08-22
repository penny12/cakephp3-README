<?php
namespace App\Model\Table;

use App\Model\Entity\Tag;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{

    public function initialize(array $config)
    {
	$this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
	$validator->notEmpty('title')->notEmpty('body');
	return $validator;
    }

    public function isOwnedBy($articleId, $userId)
    {
	return $this->exists(['id' => $articleId, 'user_id' => $userId]);
    }
}
