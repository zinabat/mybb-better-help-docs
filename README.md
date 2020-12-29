[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

# Mybb Better Help Docs

An open source plugin for MyBB 1.8 that adds a table of contents and next/previous navigation to Help Documents.

## Feature List

- [x] Adds a table of contents to each Help Document
- [x] Adds previous and next buttons to each Help Document

## Installation

1. Download the latest release
2. Extract the files and upload them to your Mybb instance
3. Access the Admin Control Panel and install the plugin

## Templates

|template|variables|description|
|---|---|---|
|`betterhelpdocs_toc`|`$toc_list`|The Table of Contents box|
|`betterhelpdocs_toc_section`|`$section_name`|Table of Contents section|
|`betterhelpdocs_toc_list`|`$toc_list_rows`|A list of help docs for a particular section|
|`betterhelpdocs_toc_row`|`$active_class`, `$help_doc_link`, `$help_doc_desc`, `$help_doc_name`|A table of contents list item|
|`betterhelpdocs_navigation_bar`|`$help_doc_previous`, `$help_doc_next`|Navigation for a help document|
|`betterhelpdocs_navigation_button`|`$help_doc_link`, `$button_text`|Button for navigation|