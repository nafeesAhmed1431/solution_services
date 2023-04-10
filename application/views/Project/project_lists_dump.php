<div class="row">
                <?php foreach ($lists as $list) : ?>
                    <div class="col-6 mb-3">
                        <div class="form-group">
                            <input type="checkbox" class="list_check parent-check" data-list_id="<?= $list->id ?>">
                            <label class="mt-0" style="font-size: 26px;"><?= $list->title ?></label>
                        </div>
                        <?php foreach ($checklists as $checklist) : ?>
                            <?php if ($list->id == $checklist->list_id) : ?>
                                <div class="d-flex">
                                    <input class="mb-3 active_bit child-check" type="checkbox" data-p_id="<?= $checklist->project_id ?>" data-l_id="<?= $checklist->list_id ?>" data-cl_id="<?= $checklist->checklist_id ?>" onchange="active_bit(this)" value="<?= ($checklist->active_bit == 1) ?  '1' : '0' ?>" <?= ($checklist->active_bit == 1) ? 'checked' : '' ?>>
                                    <p class="ml-3 mb-3"><?= $checklist->checklist_title ?></p>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            // $('.parent-check').change(function() {
    //     var listId = $(this).data('list_id');
    //     $('.child-check[data-l_id="' + listId + '"]').prop('checked', $(this).is(':checked'));
    // });