<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.0/css/all.css">
<link rel="stylesheet" href="./resources/css/creator.min.css">
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css"/>

<div class="modal fade" id="addWidgetModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="addWidgetModalSelect"><?= __("creator.view.widget_type") ?></label>
                    <select class="custom-select" id="addWidgetModalSelect">
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __("cancel") ?></button>
                <button type="button" class="btn btn-custom" id="addWidgetBtn"><?= __("add") ?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="renameLayout" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-group">
                    <label for="layout_new_name"><?= __("creator.view.layout_name") ?></label>
                    <input type="text" class="form-control" id="layout_new_name" name="layout_new_name" placeholder="New layout name" maxlength="32">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= __("cancel") ?></button>
                <button type="button" class="btn btn-custom" id="renameLayoutBtn"><?= __("rename") ?></button>
            </div>
        </div>
    </div>
</div>

<div class="menu">
    <ul class="menu-options">
        <li class="menu-option" id="backToTheCreatorBtn"><i class="fas fa-arrow-left mr-3"></i><?= __("creator.view.go_back") ?></li>
        <hr>
        <li class="menu-option" data-toggle="modal" data-target="#addWidgetModal"><i class="fas fa-plus mr-3"></i><?= __("creator.view.add_widget") ?></li>
        <li class="menu-option d-none" id="deleteWidgetOption"><i class="fas fa-trash mr-3"></i><?= __("creator.view.delete_widget") ?></li>
        <hr>
        <li class="menu-option" data-toggle="modal" data-target="#renameLayout"><i class="fas fa-pen mr-3"></i><?= __("creator.view.rename_layout") ?></li>
        <li class="menu-option" id="save-layout-btn"><i class="fas fa-share mr-3"></i><?= __("creator.view.save_layout") ?></li>
    </ul>
</div>

<audio id="audio">
    <source id="sound" src="">
</audio>

<div class="background">
    <div class="mask"></div>
</div>

<div class="panel-config">
    <a class="panel-config__switcher switcher" href="#"  onclick="return false;" data-direction="right">
        <i class="fas fa-cogs"></i>
    </a>
    <a class="panel-config__switcher panel-config__move" href="#" onclick="return false;" data-direction="left">
        <i class="fas fa-arrow-left"></i>
    </a>

    <a class="panel-config__switcher switcher right" href="#" onclick="return false;" data-direction="left">
        <i class="fas fa-cogs"></i>
    </a>
    <a class="panel-config__switcher panel-config__move right" href="#" onclick="return false;" data-direction="right">
        <i class="fas fa-arrow-right"></i>
    </a>

    <div class="container p-0 h-100 overflow-auto">
        <div class="accordion" id="accordionSettings">
            <div class="accordion-header bg-primary w-100 p-3 text-white font-weight-bold" data-toggle="collapse" data-target="#collapse-global" aria-expanded="false" aria-controls="collapse-global">
                <i class="fas fa-file mr-2"></i><?= __("creator.view.global") ?>
                <div class="expand_caret float-right"></div>
            </div>

            <div class="p-3">
                <div id="collapse-global" class="collapse show" data-parent="#accordionSettings">
                    <div class="form-check mb-2">
                        <input type="checkbox" class="form-check-input" id="display_grid" name="display_grid" checked>
                        <label class="form-check-label" for="display_grid"><?= __("creator.view.display_grid") ?></label>
                    </div>

                    <div class="form-group">
                        <label for="song_url"><?= __("creator.view.song_url") ?> (.ogg)</label>
                        <input type="text" class="form-control" id="song_url" name="song_url" placeholder="https://www.mydomain.com/music.ogg">
                    </div>

                    <div class="form-group">
                        <label for="song_volume"><?= __("creator.view.song_volume") ?></label>
                        <input type="range" class="form-control-range" id="song_volume" name="song_volume" value="1" max="100">
                    </div>
                </div>
            </div>

            <div class="accordion-header bg-primary w-100 p-3 text-white font-weight-bold" data-toggle="collapse" data-target="#collapse-widget" aria-expanded="false" aria-controls="collapse-widget">
                <i class="fas fa-wrench mr-2"></i><?= __("creator.view.widget") ?>
                <div class="expand_caret float-right"></div>    
            </div>

            <div class="p-3">
                <div id="collapse-widget" class="collapse" data-parent="#accordionSettings">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="c-container">

</div>

<link rel="stylesheet" href="./resources/css/color-picker.min.css">
<script src="./resources/js/color-picker.min.js"></script>