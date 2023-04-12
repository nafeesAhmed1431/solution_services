<div class="row flex-nowrap card-row">
    <?php
    $gpm = 0;
    $gpc = 0;
    $list_percentages = array(); // initialize empty array
    foreach ($lists as $list) :
        $max = 0;
        $curr = 0;
        foreach ($documents as $document) :
            if ($document->checklists_list_id == $list->id) :
                $max++;
                if (!empty($document->file_name)) :
                    $curr++;
                    $gpc++;
                endif;
            endif;
        endforeach;
        $percentage = ($max > 0) ? intval(($curr / $max) * 100) : 0;
        $list_percentages[$list->id] = $percentage; // add entry to array
    ?>
        <div class="card card-1 position-relative col-sm-4 round_corner round_corner2 mb-3">
            <!-- card content -->
        </div>
    <?php endforeach; ?>
</div>