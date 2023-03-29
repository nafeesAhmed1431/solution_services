<div class="sidebar">
    <div class="main-menu">
        <div class="scroll dash-nav-items">
            <ul class="list-unstyled">
                <?php foreach ($modules as $module) : ?>
                    <li>
                        <a href="<?= base_url($module->link) ?>">
                            <i class="<?= $module->icon?>"></i>
                            <span><?= $module->title; ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
