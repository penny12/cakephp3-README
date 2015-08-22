<?php

    namespace App\Controller;

use Cake\Core\Configure;
// use Cake\ORM\Table;

class ArticlesController extends AppController
{
    public function initialize()
    {
	parent::initialize();
	$this->loadComponent('Flash');
    }

    public function index()
    {
	$this->autoLayout = false;
	// $this->autoRender = false;
	// $this->set('articles', $this->Articles->find('all'));
    }

    public function view($id=null)
    {
	$article=$this->Articles->get($id);
	$this->set(compact('article'));
    }

    // public function add()
    // {
    // 	$article = $this->Articles->newEntity();
    // 	if($this->request->is('post')) {
    // 	    $article = $this->Articles->patchEntity($article, $this->request->data);
    // 	    if($this->Articles->save($article)) {
    // 		$this->Flash->success(__('Your hed is target'));
    // 		return $this->redirect(['action'=>'index']);
    // 	    }
    // 	    $this->Flash->error(__('ads'));
    // 	}
    // 	$this->set('article', $article);
    // }

    public function delete($id)
    {
	$article = $this->Articles->get($id);
	if($this->Articles->delete($article)) {
	    $this->Flash->success(__('great{0}', h($id)));
	    return $this->redirect(['action'=>'index']);
	}
    }

    public function add()
    {
	$article = $this->Articles->newEntity();
	if ($this->request->is('post')) {
	    $article = $this->Articles->patchEntity($article, $this->request->data);
	    // Added this line
	    $article->user_id = $this->Auth->user('id');
	    // You could also do the following
	    //$newData = ['user_id' => $this->Auth->user('id')];
	    //$article = $this->Articles->patchEntity($article, $newData);
	    if ($this->Articles->save($article)) {
		$this->Flash->success(__('Your article has been saved.'));
		return $this->redirect(['action' => 'index']);
	    }
	    $this->Flash->error(__('Unable to add your article.'));
	}
	$this->set('article', $article);
    }

    public function isAuthorized($user)
    {
	// All registered users can add articles
	if ($this->request->action === 'add') {
	    return true;
	}

	// The owner of an article can edit and delete it
	if (in_array($this->request->action, ['edit', 'delete'])) {
	    $articleId = (int)$this->request->params['pass'][0];
	    if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
		return true;
	    }
	}

	return parent::isAuthorized($user);
    }


}