<?php

App::uses('AppController', 'Controller');
App::uses('Sanitize', 'Utility');

class FactoriesController extends AppController {

    public $name = 'Factories';
    public $paginate = array();
    public $helpers = array();

    public function beforeFilter() {
        parent::beforeFilter();
        if (isset($this->Auth)) {
            $this->Auth->allow('index', 'view', 'tag');
        }
    }

    function index($name = null) {
        $scope = array();
        if (!empty($name)) {
            $name = Sanitize::clean($name);
            $keywords = explode(' ', $name);
            $keywordCount = 0;
            foreach ($keywords AS $keyword) {
                if (++$keywordCount < 5) {
                    $scope[]['OR'] = array(
                        'Factory.company_id' => "{$keyword}",
                        'Factory.name LIKE' => "%{$keyword}%",
                        'Factory.address LIKE' => "%{$keyword}%",
                        'Factory.cunli LIKE' => "%{$keyword}%",
                    );
                }
            }
            $this->set('cleanKeyword', $name);
        }
        $this->paginate['Factory'] = array(
            'limit' => 20,
            'order' => array('Factory.date_registered' => 'DESC'),
        );
        $this->set('url', array($name));

        if (!empty($name)) {
            $name = "{$name} 相關";
        }
        $this->set('title_for_layout', $name . '工廠 @ ');
        $this->set('items', $this->paginate($this->Foundation, $scope));
    }

    function view($id = null) {
        if (!empty($id)) {
            $factory = $this->Factory->find('first', array(
                'conditions' => array(
                    'Factory.id' => $id,
                ),
                'contain' => array(
                    'Tag' => array(
                        'fields' => array('id'),
                    ),
                ),
            ));
        }
        if (empty($factory)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
        $tagNames = array();
        foreach ($factory['Tag'] AS $tag) {
            $tagNames[$tag['id']] = $this->Factory->Tag->getPath($tag['id'], array('id', 'name'));
        }
        $this->set('factory', $factory);
        $this->set('tagNames', $tagNames);
        if (intval($factory['Factory']['latitude']) != 0 && intval($factory['Factory']['longitude']) != 0) {
            $items = $this->Factory->find('near', array(
                'fields' => array(
                    'id', 'name', 'address'
                ),
                'limit' => 15,
                'distance' => 30,
                'unit' => 'k',
                'address' => array(
                    $factory['Factory']['latitude'],
                    $factory['Factory']['longitude'],
                ),
            ));
            $this->set('nearPoints', $items);
        }
        $this->set('title_for_layout', $factory['Factory']['name'] . ' @ ');
    }

    public function tag($tagId = 0, $name = '') {
        $tagId = intval($tagId);
        if ($tagId > 0) {
            $tag = $this->Factory->Tag->find('first', array(
                'conditions' => array('Tag.id' => $tagId),
            ));
        }
        if (!empty($tag)) {

            $scope = array(
                'Tag.lft >=' => $tag['Tag']['lft'],
                'Tag.rght <=' => $tag['Tag']['rght'],
            );
            if (!empty($name)) {
                $name = Sanitize::clean($name);
                $keywords = explode(' ', $name);
                $keywordCount = 0;
                foreach ($keywords AS $keyword) {
                    if (++$keywordCount < 5) {
                        $scope[]['OR'] = array(
                            'Factory.company_id' => "{$keyword}",
                            'Factory.name LIKE' => "%{$keyword}%",
                            'Factory.address LIKE' => "%{$keyword}%",
                            'Factory.cunli LIKE' => "%{$keyword}%",
                        );
                    }
                }
                $this->set('cleanKeyword', $name);
            }
            $this->paginate['Factory'] = array(
                'limit' => 20,
                'order' => array('Factory.date_registered' => 'DESC'),
                'joins' => array(
                    array(
                        'table' => 'factories_tags',
                        'alias' => 'FactoriesTag',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Factory.id = FactoriesTag.factory_id',
                        ),
                    ),
                    array(
                        'table' => 'tags',
                        'alias' => 'Tag',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Tag.id = FactoriesTag.tag_id',
                        ),
                    ),
                ),
            );
            $items = $this->paginate($this->Factory, $scope);
            $parents = $this->Factory->Tag->getPath($tagId, array('id', 'name'));
            $this->set('url', array($tagId));
            $this->set('tag', $tag);
            $this->set('parents', $parents);
            $this->set('children', $this->Factory->Tag->find('all', array(
                        'fields' => array('id', 'name'),
                        'order' => array('Tag.name' => 'ASC'),
                        'conditions' => array('Tag.parent_id' => $tagId),
            )));
            $this->set('items', $items);
            $prefix = implode(' > ', Set::extract('{n}.Tag.name', $parents));
            if(!empty($name)) {
                $prefix .= " [{$name}]";
            }
            $this->set('title_for_layout', $prefix . ' 工廠一覽 @ ');
        } else {
            $this->Session->setFlash('請依據網頁指示操作');
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_index($foreignModel = null, $foreignId = 0, $op = null) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();


        $habtmKeys = array(
            'Tag' => 'Tag_id',
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);

        $scope = array();
        if (array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['Factory.' . $foreignKeys[$foreignModel]] = $foreignId;

            $joins = array(
                'Tag' => array(
                    0 => array(
                        'table' => 'factories_tags',
                        'alias' => 'FactoriesTag',
                        'type' => 'inner',
                        'conditions' => array('FactoriesTag.Factory_id = Factory.id'),
                    ),
                    1 => array(
                        'table' => 'tags',
                        'alias' => 'Tag',
                        'type' => 'inner',
                        'conditions' => array('FactoriesTag.Tag_id = Tag.id'),
                    ),
                ),
            );
            if (array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['Factory.' . $foreignKeys[$foreignModel]]);
                if ($op != 'set') {
                    $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                    $this->paginate['Factory']['joins'] = $joins[$foreignModel];
                }
            }
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['Factory']['limit'] = 20;
        $items = $this->paginate($this->Factory, $scope);

        if ($op == 'set' && !empty($joins[$foreignModel]) && !empty($foreignModel) && !empty($foreignId) && !empty($items)) {
            foreach ($items AS $key => $item) {
                $items[$key]['option'] = $this->Factory->find('count', array(
                    'joins' => $joins[$foreignModel],
                    'conditions' => array(
                        'Factory.id' => $item['Factory']['id'],
                        $foreignModel . '.id' => $foreignId,
                    ),
                ));
                if ($items[$key]['option'] > 0) {
                    $items[$key]['option'] = 1;
                }
            }
            $this->set('op', $op);
        }

        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }

    function admin_view($id = null) {
        if (!$id || !$this->data = $this->Factory->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Factory->create();
            if ($this->Factory->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if ($this->Factory->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this->Factory->read(null, $id);
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page', true));
        } else if ($this->Factory->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

    function admin_habtmSet($foreignModel = null, $foreignId = 0, $id = 0, $switch = null) {
        $habtmKeys = array(
            'Tag' => array(
                'associationForeignKey' => 'Tag_id',
                'foreignKey' => 'Factory_id',
                'alias' => 'FactoriesTag',
            ),
        );
        $foreignModel = array_key_exists($foreignModel, $habtmKeys) ? $foreignModel : null;
        $foreignId = intval($foreignId);
        $id = intval($id);
        $switch = in_array($switch, array('on', 'off')) ? $switch : null;
        if (empty($foreignModel) || $foreignId <= 0 || $id <= 0 || empty($switch)) {
            $this->set('habtmMessage', __('Wrong Parameters'));
        } else {
            $habtmModel = &$this->Factory->$habtmKeys[$foreignModel]['alias'];
            $conditions = array(
                $habtmKeys[$foreignModel]['associationForeignKey'] => $foreignId,
                $habtmKeys[$foreignModel]['foreignKey'] => $id,
            );
            $status = ($habtmModel->find('count', array(
                        'conditions' => $conditions,
                    ))) ? 'on' : 'off';
            if ($status == $switch) {
                $this->set('habtmMessage', __('Duplicated operactions', true));
            } else if ($switch == 'on') {
                $habtmModel->create();
                if ($habtmModel->save(array($habtmKeys[$foreignModel]['alias'] => $conditions))) {
                    $this->set('habtmMessage', __('Updated', true));
                } else {
                    $this->set('habtmMessage', __('Update failed', true));
                }
            } else {
                if ($habtmModel->deleteAll($conditions)) {
                    $this->set('habtmMessage', __('Updated', true));
                } else {
                    $this->set('habtmMessage', __('Update failed', true));
                }
            }
        }
    }

}
