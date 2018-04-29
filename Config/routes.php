<?php
Router::connect('/Homemodal/set_viewed', array('controller' => 'Homemodal', 'action' => 'set_viewed', 'plugin' => 'MyHomeModal', 'admin' => false));

Router::connect('/admin/homemodal/homemodal', array('controller' => 'Homemodal', 'action' => 'index', 'plugin' => 'MyHomeModal', 'admin' => true));
Router::connect('/admin/homemodal', array('controller' => 'Homemodal', 'action' => 'index', 'plugin' => 'MyHomeModal', 'admin' => true));

Router::connect('/admin/homemodal/ajax_save', array('controller' => 'Homemodal', 'action' => 'ajax_save', 'plugin' => 'MyHomeModal', 'admin' => true));