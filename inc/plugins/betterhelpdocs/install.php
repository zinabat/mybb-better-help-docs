<?php

if (!defined("IN_MYBB")) {
    die("Direct initialization of this file is not allowed.");
}

function betterhelpdocs_info()
{
    return [
        "name"          => "Better Help Documments",
        "description"   => "Extends the functionality of MyBB Help Docs",
        "website"       => "https://github.com/zinabat/mybb-better-help-docs",
        "author"        => "Zina Ramirez",
        "authorsite"    => "https://www.linkedin.com/in/zina-ramirez-7125bb90/",
        "version"       => "0.0",
        "guid"          => "",
        "codename"      => "betterhelpdocs",
        "compatibility" => "18*"
    ];
}

function betterhelpdocs_is_installed()
{
    global $db;
    $query = $db->simple_select('templategroups', 'prefix', 'prefix="betterhelpdocs"');
    if ($db->num_rows($query) > 0) {
        return true;
    }
    return false;
}

function betterhelpdocs_install()
{
    global $db;
    // add templates
    require_once(PLUGIN_BETTERHELPDOCS_ROOT . '/templates.php');

    $db->insert_query('templategroups', [
        'prefix' => 'betterhelpdocs',
        'title'  => 'Better Help Docs',
        'isdefault' => 1
    ]);
    $template_queries = [];
    foreach ($templates as $name => $template) {
        $template_queries[] = [
            'title' => 'betterhelpdocs_' . $name,
            'template' => $db->escape_string($template),
            'sid' => '-2',
            'version' => '',
            'dateline' => TIME_NOW
        ];
    }
    $db->insert_query_multiple('templates', $template_queries);
}

function betterhelpdocs_uninstall()
{
    global $db;
    $db->delete_query('templates', 'title LIKE "betterhelpdocs%"');
    $db->delete_query('templategroups', 'prefix="betterhelpdocs"');
}

function betterhelpdocs_activate()
{
    require_once(MYBB_ROOT.'inc/adminfunctions_templates.php');
    find_replace_templatesets('misc_help_helpdoc', '#'.preg_quote('{$helpdoc[\'document\']}').'#', '{$toc}{$helpdoc[\'document\']}{$navigation}');
}

function betterhelpdocs_deactivate()
{
    require_once(MYBB_ROOT.'inc/adminfunctions_templates.php');
    find_replace_templatesets('misc_help_helpdoc', '#'.preg_quote('{$toc}').'#', '');
    find_replace_templatesets('misc_help_helpdoc', '#'.preg_quote('{$navigation}').'#', '');
}