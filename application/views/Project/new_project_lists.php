<style>
    .list_check {
        width: 20px;
        height: 20px;
    }
</style>
<div class="container-fluid disable-text-selection">
    <div class="col-12">
        <section class="content-header mb-5">
            <h1 class="ml-0 text-large">
                <?= $pageHeading; ?>
            </h1>
        </section>
        <section class="container">
            <div class="row">
                <?php
                $lcl = array();
                foreach ($lists as $list) {
                    $lcl[$list->id] = array('total' => 0, 'active' => 0);
                ?>
                    <div class="col-6 mb-3">
                        <div class="form-group">
                            <input type="checkbox" class="list_check parent-check" data-list_id="<?= $list->id ?>" data-status="0">
                            <label class="mt-0" style="font-size: 26px;"><?= $list->title ?></label>
                        </div>
                        <?php foreach ($checklists as $checklist) : ?>
                            <?php if ($list->id == $checklist->list_id) {
                                $lcl[$list->id]['total']++;
                                if ($checklist->active_bit == 1) {
                                    $lcl[$list->id]['active']++;
                                }
                            } ?>
                            <?php if ($list->id == $checklist->list_id) : ?>
                                <div class="d-flex">
                                    <input class="mb-3 active_bit child-check" type="checkbox" data-p_id="<?= $checklist->project_id ?>" data-l_id="<?= $checklist->list_id ?>" data-cl_id="<?= $checklist->checklist_id ?>" onchange="active_bit(this)" value="<?= ($checklist->active_bit == 1) ?  '1' : '0' ?>" <?= ($checklist->active_bit == 1) ? 'checked' : '' ?>>
                                    <p class="ml-3 mb-3"><?= $checklist->checklist_title ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php } ?>
            </div>
            <a href='<?= base_url('Project/project_details/') . $checklist->project_id; ?>' class="btn btn-block btn-danger" type="submit">Update</a>
        </section>
    </div>
</div>
<input type="hidden" id="callBackLoc" value="<?= base_url('admin'); ?>" />
<input type="hidden" id="pid" value="<?= $project_id ?? 0 ?>" />
<script src="<?= base_url(); ?>Assets/js/custum/district_view.js"></script>

<script>
    var record_array = <?= json_encode($lcl) ?>;


    $(document).ready(function() {
        $('.parent-check').each(function() {
            var listId = $(this).data('list_id');
            var total = record_array[listId].total;
            var active = record_array[listId].active;
            $(this).prop('checked', active == total);
            $(this).attr('data-status', active == total ? 1 : 0);
        });
    });


    $('.child-check').change(function() {
        var listId = $(this).data('l_id');
        var totalChecklists = lcl[listId]['total'];
        var activeChecklists = $('.child-check[data-l_id="' + listId + '"]:checked').length;
        $('.parent-check[data-list_id="' + listId + '"]').prop('checked', totalChecklists == activeChecklists);
    });

    function active_bit(e) {
        var active_bit = $(e).val();
        var p_id = $(e).attr('data-p_id');
        var l_id = $(e).attr('data-l_id');
        var cl_id = $(e).attr('data-cl_id');
        $.ajax({
            url: base_url + 'Project/update_checklists',
            method: 'GET',
            contentType: "application/json; charset:utf-8",
            dataType: 'json',
            data: {
                'pid': p_id,
                'lid': l_id,
                'clid': cl_id,
                'active_bit': active_bit,
                'active_bit1': (active_bit == 0 ? 1 : 0)
            },
            success: function(res) {
                if (res.file_check == 1) {
                    $(e).prop('checked', true);
                    alert('Document Is Uploaded, Unable To Uncheck');
                    return;
                } else {
                    if (active_bit == 0) {
                        active_bit = 1;
                    } else {
                        active_bit = 0;
                    }
                    $(e).val(active_bit);
                    console.log(active_bit);
                }
            },
            error: function(res) {
                alert();
            },
            failure: function(res) {
                alert();
            }
        });
    }

    $(".parent-check").on("change", function() {
        let update_list = $.ajax({
            url: base_url + 'Project/update_list',
            method: 'POST',
            dataType: 'JSON',
            data: {
                project_id: $('#pid').val(),
                list_id: $(this).data('list_id'),
                status : $(this).data('status')
            }
        });

        update_list.then(res => {
            if (res.status) {
                const childCheckboxes = $(this).closest(".col-6").find(".child-check");
                childCheckboxes.prop("checked", $(this).prop("checked"));
            }
        });
        update_list.catch(error => {
            console.log(error);
        });
    });
</script>