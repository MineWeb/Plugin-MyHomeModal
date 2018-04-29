<?php
App::import('MyHomeModal.Controller/Component', 'HomeModalComponent');
$modal = new HomeModalComponent();
if(!$modal->isShowed() && $modal->getShowed()):
    ?>
    <div class="modal fade" id="home_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="home_modal_title"><?= $modal->getTitle() ?></h4>
                </div>
                <div class="modal-body" id="home_modal_content">
                    <?= $modal->getContent() ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            if($("#home_modal_title").text().length == 0){
                $('#home_modal_title').html("&nbsp;");
            }

            if($("#home_modal_content").text().length == 0){
                $('#home_modal_content').hide();
            }
            $('#home_modal').modal("show");
            function sendRequest(){
              data = {};
              data["data[_Token][key]"] = '<?= $csrfToken ?>';
                $.ajax({
                    method: "POST",
                    url: "<?= $this->Html->url(array('controller' => 'Homemodal', 'action' => 'set_viewed')) ?>",
                    data: data
                }).fail(function(){
                    sendRequest();
                });
            }
            sendRequest();
        });
    </script>
    <?php
endif;
?>
