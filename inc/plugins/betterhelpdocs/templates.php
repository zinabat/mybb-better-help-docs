<?php

if (!defined("IN_MYBB")) {
    die("Direct initialization of this file is not allowed.");
}

$templates = [
'toc' => '
    <div id="help-docs-toc">
        <div class="toc-header">Table of Contents</div>
        {$toc_list}
    </div>',
'toc_section' => '
    <div class="toc-section">{$section_name}</div>',
'toc_list' => '
    <ol>
        {$toc_list_rows}
    </ol>',
'toc_row' => '
    <li class="{$active_class}"><a href="{$help_doc_link}" title="{$help_doc_desc}">{$help_doc_name}</a></li>',
'navigation_bar' => '
    <div id="help-docs-nav">
        {$help_doc_previous}
        {$help_doc_next}
    </div>',
'navigation_button' => '
    <a href="{$help_doc_link}" class="button">{$button_text}</a>'
];