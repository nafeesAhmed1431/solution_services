
<div class="container-fluid disable-text-selection">
    <div class="col-12">
        <section class="content-header mb-5">
            <h1 class="ml-0 text-large">
                <?php echo $pageHeading; ?>
            </h1>
        </section>
        <section class="container">
            <form action="<?php echo base_url('Project/insert_checklists');?>">
                <div class="row">
                    <?php foreach($lists as $list): ?>
                        <div class="col-6 mb-3" >
                            <h3 class="mt-0" style="font-size: 26px;"><?= $list->title?></h2>
                            <?php foreach($checklists as $checklist): ?>
                                <?php if($list->id == $checklist->list_id) {?>
                                    <div class="d-flex">
                                        <input class="mb-3 active_bit" type="checkbox" data-p_id="<?= $checklist->project_id?>" data-l_id="<?= $checklist->list_id?>" data-cl_id="<?= $checklist->checklist_id?>" onchange="active_bit(this)" value="<?= ($checklist->active_bit == 1) ?  '1' : '0'?>" <?= ($checklist->active_bit == 1) ? 'checked' : '' ?>>
                                        <p class="ml-3 mb-3"><?= $checklist->checklist_title?></p> 
                                    </div>
                                <?php }?>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href = '<?php echo base_url('Project/project_details/') . $checklist->project_id;?>' class="btn btn-block btn-danger" type="submit">Update</a>
            </form>
        </section>
        <input type="hidden" id="callBackLoc" value="<?php echo base_url('admin'); ?>" />
        <script src="<?php echo base_url(); ?>Assets/js/custum/district_view.js"></script>
    </div>
</div>
<script>
    function active_bit(e) {
        var active_bit = $(e).val();
        
        // if(active_bit == 0) {
        //     active_bit = 1;
        //     $(e).val('1');
        // }else {
        //     active_bit = 0;
        //     $(e).val('0');
        // }
        var p_id       = $(e).attr('data-p_id');
        var l_id       = $(e).attr('data-l_id');
        var cl_id      = $(e).attr('data-cl_id');
        $.ajax({
        url: base_url + 'Project/update_checklists',
        method: 'GET',
        contentType: "application/json; charset:utf-8",
        dataType: 'json',
        data: {
            'pid'        : p_id,
            'lid'        : l_id,
            'clid'       : cl_id, 
            'active_bit' : active_bit,
            'active_bit1' : (active_bit == 0 ? 1 : 0)
        },
        success: function(res){
            if(res.file_check == 1){
                $(e).prop('checked', true);
                alert('Document Is Uploaded, Unable To Uncheck');
                return;
            }else{
                if(active_bit == 0) {
                    active_bit = 1;
                }else {
                    active_bit = 0;
                }
                $(e).val(active_bit);
                console.log(active_bit);
            }
        },
        error: function (res) {
            alert();
        },
        failure: function (res) {
            alert();
        }
    });
        // if ($(e).val() == '0') {
        //     $(e).val('1');
        // }
        // else {
        //     $(e).val('0');
        // }
    }
</script>
