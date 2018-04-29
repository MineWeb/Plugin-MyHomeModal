<?php
class Homemodal extends AppModel{

    public $useTable = "myhomemodal__homemodal";

    public function afterSave($created, $options=[]){
        if($created)
            $this->getEventManager()->dispatch(new CakeEvent('afterHomeModalSave', $this));
    }

}
