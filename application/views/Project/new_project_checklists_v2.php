<style>
    .list_checkbox {
        width: 20px;
        height: 20px;
        position: absolute;
        left: 13px;
        top: -3px;
    }
</style>
<div class="container-fluid disable-text-selection">
    <div class="row">
        <div class="col-12">
            <section class="content-header mb-5">
                <h1 class="ml-0 text-large">
                    <?php echo $pageHeading; ?>
                </h1>
            </section>
            <section class="container">
                <div class="row">
                    <?php
                    $lists = array();

                    foreach ($records as $record) {
                        $list_title = $record->list_title;
                        if (!isset($lists[$list_title])) {
                            $lists[$list_title] = array();
                        }
                        $lists[$list_title][] = $record;
                        $list_ids[$list_title] = $record->list_id;
                    } ?>

                    <?php foreach ($lists as $key => $records) : ?>
                        <div class="col-4 mb-2">
                            <div class="card rounded">
                                <div class="card-body">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input list_checkbox" type="checkbox" data-lid="<?= $list_ids[$key] ?>" data-status="0">
                                        <h2 class="card-title font-weight-bold mb-0"><?= $key ?></h2>
                                    </div>
                                    <?php
                                    $processes = array();
                                    foreach ($records as $record) {
                                        $process_title = $record->process_title;
                                        if (!isset($processes[$process_title])) {
                                            $processes[$process_title] = array();
                                        }
                                        $processes[$process_title][] = $record;
                                        $process_ids[$process_title] = $record->process_id;
                                    } ?>

                                    <?php foreach ($processes as $process_title => $sub_records) : ?>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input process_checkbox" type="checkbox" data-pid="<?= $process_ids[$process_title] ?>" data-status="0">
                                            <label class="form-check-label font-weight-bold" for="process-<?= $process_title ?>"><?= $process_title ?></label>
                                            <div class="ml-0">
                                                <?php foreach ($sub_records as $sub_record) : ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input checklist_checkbox" type="checkbox" <?= $sub_record->active == 1 ? "checked" : "" ?> data-clid="<?= $sub_record->checklist_id ?>" data-status="<?= $sub_record->active ?>" <?=$sub_record->status == 1 ? "disabled" : "" ?> title="<?=$sub_record->status == 1 ? "Document is Already uploaded, Cannot Uncheck" : "Click to Check and Add checklist to Project" ?>" >
                                                        <label class="form-check-label"><?= $sub_record->checklist_title ?></label>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-6">
            <a class="btn btn-success btn-block btn-sm" href="<?= base_url('') ?>">Update</a>
        </div>
    </div>
</div>

<input type="hidden" id="base_url" value="<?= base_url(); ?>" />
<input type="hidden" id="pid" value="<?= $pid ?? 0 ?>">
<script>
    let pid = $('#pid').val();
    let base_url = $('#base_url').val();

    $('.list_checkbox').on('click', function() {
        let lid = $(this).data('lid');
        $.ajax({
            url: base_url + 'project/update_project_list_v1',
            method: 'GET',
            dataType: 'JSON',
            data: {
                pid: pid,
                lid: lid
            },
            success: res => {

            },
            error: res => {},
        });
    });

    $('.process_checkbox').on('click', function() {
        let process_id = $(this).data('pid');
        $.ajax({
            url: base_url + 'project/update_project_process_v1',
            method: 'GET',
            dataType: 'JSON',
            data: {
                project_id: pid,
                process_id: process_id,
            },
            success: res => {

            },
            error: res => {},
        });
    });

    $('.checklist_checkbox').on('click', function() {
        let clid = $(this).data('clid');
        let status = $(this).data('status');
        $.ajax({
            url: base_url + 'project/update_project_checklist_v1',
            method: 'GET',
            dataType: 'JSON',
            data: {
                project_id: pid,
                clid: clid,
                status: status == 1 ? 0 : 1
            },
            success: res => {
                $(this).data('status', status == 1 ? 0 : 1);
            }
        });
    });

    // handle list checkboxes
    $('.list_checkbox').click(function() {
        var lid = $(this).data('lid');
        var status = $(this).is(':checked') ? 1 : 0;
        $('[data-lid="' + lid + '"]').prop('checked', status);
    });

    // handle process checkboxes
    $('.process_checkbox').click(function() {
        var pid = $(this).data('pid');
        var status = $(this).is(':checked') ? 1 : 0;
        $('[data-pid="' + pid + '"]').prop('checked', status);
    });

    // handle checklist checkboxes
    $('.checklist_checkbox').click(function() {
        var clid = $(this).data('clid');
        var status = $(this).is(':checked') ? 1 : 0;
        $('[data-chid="' + clid + '"]').prop('checked', status);
    });
</script>