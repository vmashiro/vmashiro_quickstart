<?php
/**
 * @package     Solo
 * @copyright   2014-2016 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license     GNU GPL version 3 or later
 */

use \Awf\Text\Text;
use \Awf\Html;
use Solo\Helper\Escape;

// Used for type hinting
/** @var  \Solo\View\Alice\Html  $this */

$router = $this->container->router;

?>
<?php if(count($this->logs)): ?>
<form name="adminForm" id="adminForm" action="<?php echo $router->route('index.php?view=alice') ?>" method="POST" class="form-inline">
	<input type="hidden" name="token" value="<?php echo $this->container->session->getCsrfToken()->getValue() ?>" >

    <?php if($this->input->getInt('autorun', 0)): ?>
        <div class="alert alert-warning">
            <?php echo Text::_('ALICE_AUTORUN_NOTICE')?>
        </div>
    <?php endif; ?>

	<fieldset>
		<label for="tag">
			<?php echo Text::_('LOG_CHOOSE_FILE_TITLE'); ?>
		</label>
		<?php echo Html\Select::genericList($this->logs, 'log', '', 'value', 'text', $this->tag, 'soloLogSelect') ?>


        <button class="btn btn-primary" id="analyze-log" style="display:none">
			<span class="glyphicon glyphicon-download"></span>
			<?php echo Text::_('SOLO_ALICE_ANALYZE'); ?>
		</button>
	</fieldset>

    <div id="stepper-holder" style="margin-top: 15px">
        <div id="stepper-loading" style="text-align: center;display: none">
            <img src="<?php echo \Awf\Uri\Uri::base(false, $this->container) . 'media/loading.gif' ?>" />
        </div>
        <div id="stepper-progress-pane" style="display: none">
            <div class="alert alert-warning">
                <span class="glyphicon glyphicon-warning-sign"></span>
                <?php echo Text::_('BACKUP_TEXT_BACKINGUP'); ?>
            </div>
            <fieldset>
                <legend><?php echo Text::_('ALICE_ANALYZE_LABEL_PROGRESS') ?></legend>
                <div id="stepper-progress-content">
                    <div id="stepper-steps">
                    </div>
                    <div id="stepper-status" class="well">
                        <div id="stepper-step"></div>
                        <div id="stepper-substep"></div>
                    </div>
                    <div id="stepper-percentage" class="progress">
                        <div class="bar" style="width: 0%"></div>
                    </div>
                    <div id="response-timer">
                        <div class="color-overlay"></div>
                        <div class="text"></div>
                    </div>
                </div>
                <span id="ajax-worker"></span>
            </fieldset>
        </div>
        <div id="output-plain" style="display:none;margin-bottom: 20px;">
            <p><em><strong><?php echo Text::_('ALICE_ANALYZE_RAW_OUTPUT')?></strong></em></p>
            <textarea style="width:50%;margin:auto;display:block;height: 100px;" readonly="readonly"></textarea>
        </div>
        <div id="stepper-complete" style="display: none">
        </div>
    </div>
</form>
<?php else: ?>
<div class="alert alert-danger">
	<?php echo Text::_('LOG_NONE_FOUND') ?>
</div>
<?php endif; ?>
<script type="application/javascript">
	Solo.loadScripts[Solo.loadScripts.length] = function () {
		(function($){
        // Push translations
        Solo.Alice.translations['UI-LASTRESPONSE']	    = '<?php echo Escape::escapeJS(Text::_('BACKUP_TEXT_LASTRESPONSE')) ?>';
        Solo.Alice.translations['UI-STW-CONTINUE']	    = '<?php echo Escape::escapeJS(Text::_('STW_MSG_CONTINUE')) ?>';
        Solo.Alice.translations['SOLO_ALICE_SUCCESSS']  = '<?php echo Escape::escapeJS(Text::_('SOLO_ALICE_SUCCESSS')) ?>';
        Solo.Alice.translations['SOLO_ALICE_WARNING']	= '<?php echo Escape::escapeJS(Text::_('SOLO_ALICE_WARNING')) ?>';
        Solo.Alice.translations['SOLO_ALICE_ERROR']	    = '<?php echo Escape::escapeJS(Text::_('SOLO_ALICE_ERROR')) ?>';
		Solo.Alice.akeebaUrl = '<?php echo $router->route('index.php?view=alice')?>';

		Solo.Alice.analyze = $('#analyze-log');
		Solo.Alice.log_selector = $('#soloLogSelect');
		Solo.Alice.raw_output = $('#output-plain');

		Solo.Alice.log_selector.attr('disabled', null);
		Solo.Alice.log_selector.change(Solo.Alice.onLogChange);
		Solo.Alice.analyze.click(Solo.Alice.onAnalyze);
		Solo.Alice.raw_output.find('textarea').focus(Solo.Alice.onFocus);

    <?php if($this->tag): ?>
        Solo.Alice.log_selector.change();
        Solo.Alice.analyze.click();
    <?php endif;?>

		}(akeeba.jQuery));
	};
</script>