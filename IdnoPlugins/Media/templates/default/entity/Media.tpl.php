<?php

    if (\Idno\Core\site()->currentPage()->isPermalink()) {
        $rel = 'rel="in-reply-to"';
    } else {
        $rel = '';
    }
?>
    <h2 class="p-name"><a href="<?= $vars['object']->getURL(); ?>"><?= htmlentities(strip_tags($vars['object']->getTitle()), ENT_QUOTES, 'UTF-8'); ?></a></h2>
<?php
    if ($attachments = $vars['object']->getAttachments()) {
        foreach ($attachments as $attachment) {
            $mainsrc = $attachment['url'];
            if (substr($attachment['mime-type'], 0, 5) == 'video') {
                ?>
                <p style="text-align: center">
                    <video src="<?= $this->makeDisplayURL($mainsrc) ?>" class="u-video known-media-element" controls preload="none"></video>
                </p>
            <?php

            } else {

                ?>
                <p style="text-align: center">
                    <audio src="<?= $this->makeDisplayURL($mainsrc) ?>" class="u-audio known-media-element" controls preload="none"></audio>
                </p>
            <?php

            }
        }
    }
?>
<?= $this->autop($this->parseHashtags($this->parseURLs($vars['object']->body, $rel))) ?>

<?php
    if (!empty($vars['object']->tags)) {
?>

<p class="tag-row"><i class="icon-tag"></i> <?=$this->parseHashtags($vars['object']->tags)?></p>

<?php }
