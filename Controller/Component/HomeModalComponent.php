<?php
App::uses('Homemodal', 'MyHomeModal.Model');
class HomeModalComponent extends Component {

    private $homeModal = null;
    private $modal = [];

    public function __construct() {
        $this->homeModal = new Homemodal();
        $this->modal = current($this->homeModal->find('first'));
    }

    public function isShowed(){
        if(!CakeSession::check("HomeModal.showed") || CakeSession::read("HomeModal.showed") == "false")
            return false;
        return true;
    }

    public function getTitle(){
        return $this->modal['title'];
    }

    public function getContent(){
        return $this->modal['content'];
    }

    public function getShowed(){
        return $this->modal['showed'];
    }

    public function canShowed(){
        return $this->modal['showed'];
    }

}