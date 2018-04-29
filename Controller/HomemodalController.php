<?php
class HomemodalController extends MyHomeModalAppController{

    public function set_viewed($isShowed){
        $this->layout = null;
        $this->autoRender = false;
        if($this->request->is('post')) {
            if(!CakeSession::read("HomeModal.showed"))
                CakeSession::write("HomeModal.showed", "true");
            else
                CakeSession::write("HomeModal.showed", "false");
        }
    }

    public function admin_index(){
        if($this->isConnected && $this->User->isAdmin()){
            $this->set('title_for_layout', $this->Lang->get('HOME_MODAL'));
            $this->layout = 'admin';
            $hm = $this->Homemodal->find('first');
            if(!empty($hm))
                $hm = current($hm);
            $this->set(compact("hm"));
        }
        else
            throw new ForbiddenException();

    }

    public function admin_ajax_save(){
        $this->layout = null;
        $this->autoRender = false;
        if($this->isConnected && $this->User->isAdmin()){
            if($this->request->is('post')) {
                $data = $this->request->data;
                $return = 0;
                $hm['id'] = 1;
                $hm['title'] = $data['title'];
                $hm['content'] = $data['content'];
                $hm['showed'] = ($data['showed'] == "false") ? false : true;
                if ($this->Homemodal->save($hm)){
                    $return = json_encode($hm);
                }
                else
                    $return = 1;

                $this->response->type('json');
                $this->response->body($return);
            }
        }
        else
          throw new ForbiddenException();
    }

}
