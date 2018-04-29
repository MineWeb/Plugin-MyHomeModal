<section class="content">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $Lang->get("HOME_MODAL"); ?></h3>
            </div>
            <div class="box-body">
                <div id="alert_msg"></div>
                <form id="modal_form" action="">
                    <input type="hidden" name="action" id="action">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="question"><?= $Lang->get("TITLE") ?></label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= (!empty($hm)) ? $hm['title'] : "" ?>" placeholder="<?= $Lang->get("ENTER_TITLE") ?>">
                    </div>
                    <div class="form-group">
                        <label for="answer"><?= $Lang->get("CONTENT") ?></label>
                        <?= $this->Html->script('admin/tinymce/tinymce.min.js') ?>
                        <script type="text/javascript">
                            tinymce.init({
                                selector: "textarea",
                                height : 300,
                                width : '100%',
                                language : 'fr_FR',
                                plugins: "textcolor code image link",
                                toolbar: "fontselect fontsizeselect bold italic underline strikethrough link image forecolor backcolor alignleft aligncenter alignright alignjustify cut copy paste bullist numlist outdent indent blockquote code"
                            });
                        </script>
                        <textarea id="editor" name="content" id="content" cols="30" rows="10"><?= (!empty($hm)) ? $hm['content'] : "" ?></textarea>
                    </div>
                    <div class="checkbox">
                      <input type="checkbox" name="showed" id="is_showed" <?= (!empty($hm) && $hm['showed']) ? "checked" : "" ?>>
                      <label>
                        <?= $Lang->get("MODAL_SHOWED"); ?>
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary"><?= $Lang->get("GLOBAL__EDIT") ?></button>
                    <button type="button" class="btn btn-info" onclick="Homemodal.preview()"><?= $Lang->get("PREVIEW") ?></button>
                </form>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>

<!-- Preview Modal -->

<div class="modal fade" id="preview_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="preview_title"></h4>
            </div>
            <div class="modal-body" id="preview_content">
            </div>
        </div>
    </div>
</div>

<script>
    var Homemodal = {};
    Homemodal.preview = function(event){
        $('#preview_content').show();
        if($("#title").val().length == 0){
            $('#preview_title').html("&nbsp;");
        }else{
            $('#preview_title').text($("#title").val());
        }

        if(tinymce.activeEditor.getContent().length == 0){
            $('#preview_content').hide();
        }else{
            $('#preview_content').html(tinymce.activeEditor.getContent());
        }
        $('#preview_modal').modal("show");
    };

    Homemodal.submitForm = function(event){
        event.preventDefault();
        event.stopPropagation();

        var inputs = {
            title: $('#title').val(),
            content: tinymce.activeEditor.getContent(),
            showed: $('#is_showed').is(":checked")
        };
        inputs["data[_Token][key]"] = '<?= $csrfToken ?>';
        $.ajax({
            method: "POST",
            url: "<?= $this->Html->url(array('controller' => 'Homemodal', 'action' => 'ajax_save')) ?>",
            data: inputs
        })
            .done(function(data) {
                console.log(data);
                if(typeof data == "object"){
                    $('#alert_msg').html('' +
                        '<div class="alert alert-success">' +
                        '<?= $Lang->get("MODAL_SUCCESSFULY_EDITED") ?>' +
                        '</div>'
                    );
                }
                else if(data == 0)
                    $('#alert_msg').html('' +
                        '<div class="alert alert-error">' +
                        '<?= $Lang->get("MODAL_ERROR") ?>. error : 1' +
                        '</div>'
                    );

            })
            .fail(function() {
                $('#alert_msg').html('' +
                    '<div class="alert alert-error">' +
                    '<?= $Lang->get("MODAL_ERROR") ?>. error : 2' +
                    '</div>'
                );
            })
            .always(function() {
                console.log("lol");
            });
    };
    $('#modal_form').submit(Homemodal.submitForm);

</script>
