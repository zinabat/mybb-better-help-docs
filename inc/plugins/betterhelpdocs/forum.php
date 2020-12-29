<?php
/**
 * Hooks for the forums
 */
if (!defined("IN_MYBB")) {
    die("Direct initialization of this file is not allowed.");
}

$plugins->add_hook('misc_help_helpdoc_end', 'betterhelpdocs_view_doc');
function betterhelpdocs_view_doc()
{
    global $db, $mybb, $templates;
    // template vars
    global $toc, $navigation;
    // create the table of contents
    $docs_url = "{$mybb->settings['bburl']}/misc.php?action=help";
    $hid = $mybb->get_input('hid', MyBB::INPUT_INT);
    $query = $db->write_query("SELECT h.hid, h.name,h.description, s.sid, s.name as section_name, s.description as section_description
        FROM `mybb_helpdocs` as h
        left join `mybb_helpsections` as s on s.sid=h.sid
        where h.enabled=1 and s.enabled=1
        order by s.disporder, h.disporder");
    $toc_list = '';
    $prev_hid = null;
    $current_section = null;
    $toc_list_rows = '';
    while ($help_doc = $db->fetch_array($query)) {
        // new section
        if ($help_doc['sid'] !== $current_section) {
            // add the rows if there are any
            if ($toc_list_rows !== '') {
                eval('$toc_list .= "'. $templates->get('betterhelpdocs_toc_list') .'";');
            }
            // add the new section
            $section_name = $help_doc['section_name'];
            eval('$toc_list .= "'. $templates->get('betterhelpdocs_toc_section') .'";');
            // reset the rows
            $toc_list_rows = '';
            $current_section = $help_doc['sid'];
        }
        $active_class = '';
        // get the next and previous docs
        if ($help_doc['hid'] == $hid) {
            $active_class = 'active';
            if ($prev_hid) {
                $help_doc_link = "{$docs_url}&hid={$prev_hid}";
                $button_text = "Previous";
                eval('$help_doc_previous = "'. $templates->get('betterhelpdocs_navigation_button') .'";');
            }
        } else if ($hid == $prev_hid) {
            $help_doc_link = "{$docs_url}&hid={$help_doc['hid']}";
            $button_text = "Next";
            eval('$help_doc_next = "'. $templates->get('betterhelpdocs_navigation_button') .'";');
        }
        // generate the row
        $help_doc_link = "{$docs_url}&hid={$help_doc['hid']}";
        $help_doc_desc = $help_doc['description'];
        $help_doc_name = $help_doc['name'];
        eval('$toc_list_rows .= "'. $templates->get('betterhelpdocs_toc_row') .'";');
        $prev_hid = $help_doc['hid'];
    }
    eval('$toc_list .= "'. $templates->get('betterhelpdocs_toc_list') .'";');
    eval('$toc = "'. $templates->get('betterhelpdocs_toc') .'";');
    eval('$navigation = "'. $templates->get('betterhelpdocs_navigation_bar') .'";');
}