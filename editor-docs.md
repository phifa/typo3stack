# Editor Config Documentation

Some groups are split into "Read" and "Write". For example the `[CORE] Content (Read)` will enable database tables to be listed. If you need access to write, add the `[CORE] Content (Write)` group. It includes `[CORE] Content (Read)` and enables tables to be modified.

# ACCESS

With the [ACCESS] user groups you can define selective site access to pages and subpages. To view or edit the page access, use the panel on the left "SYSTEM -> Access". There are no further settings set up, so these are "dummy groups". For them to function properly, make sure to give proper access in the left panel and add them to the desired user group.

### [ACCESS] All

Provide access to all pages

### [ACCESS] Configuration

Provide access to just sysfolders

### [ACCESS] Default

Default access, do not change this group's uid. It's set by default.

# MOUNT

The [MOUNT] group is to limit the shown content through given entrypoints in the tree structure.

### [MOUNT] Root Default Page

Mounts DB access to the root page. Add more [MOUNT] groups for granular access.
**Note:** DB Mounts make the pagetree(s) generally available. Use the [ACCESS] groups to control the details.

# CORE

The [CORE] group defines permissions for core-related areas. E.g. if you want to change access to the filelist module, have a look at `[CORE] Files`.

### [CORE] Content (Read)

- Tables (Listing): `Page Content (tt_content)`, `Note (sys_note)`
- This group gives basic minimal access to read content

#### Allowed excludefields

##### Page Content

- ❌ Access (fe_group)
- ❌ Align (header_position)
- ✅ Border (imageborder)
- ✅ Categories (categories)
- ✅ Click-enlarge (image_zoom)
- ❌ Columns (colPos)
- ✅ Columns (imagecols)
- ✅ Date (date)
- ✅ Description (rowDescription)
- ❌ Display description (uploads_description)
- ❌ Display file/icon/thumbnail (uploads_type)
- ❌ Field Delimiter (table_delimiter)
- ❌ File collections (file_collections)
- ❌ Frame (frame_class)
- ✅ Height (pixels) (imageheight)
- ✅ Index (sectionIndex)
- ❌ Language (sys_language_uid)
- ✅ Layout (layout)
- ✅ Link (header_link)
- ✅ Position (imageorient)
- ❌ Recursive (recursive)
- ❌ Restrict editing by non-Admins (editlock)
- ❌ Show File Size (filelink_size)
- ❌ Sort file list (filelink_sorting)
- ❌ Sorting direction (filelink_sorting_direction)
- ❌ Space After (space_after_class)
- ❌ Space Before (space_before_class)
- ✅ Start (starttime)
- ❌ Startingpoint (pages)
- ✅ Stop (endtime)
- ✅ Subheader (subheader)
- ❌ Table caption (table_caption)
- ❌ Table header position (table_header_position)
- ❌ Table style (table_class)
- ❌ Text enclosure (table_enclosure)
- ✅ To top (linkToTop)
- ✅ Transl.Orig (l18n_parent)
- ✅ Type (header_layout)
- ✅ Type of bullets (bullets_type)
- ✅ Use table footer (wrap last row with <tfoot> tags) (table_tfoot)
- ✅ Visible (hidden)
- ✅ Width (pixels) (imagewidth)

### [CORE] Content (Write)

- Includes `[CORE] Content (Read)`
- Enable module **Web>Recycler**
- Tables (modify): `Page Content (tt_content)`, `Note (sys_note)`

### [CORE] Files

- Includes Basic File Mount `Files for Editors` for fileadmin `/` access
- Enable module **File>Filelist**
- Tables (modify): `File`

* ✅ Directory: Read
* ✅ Directory: Write
* ✅ Directory: Add
* ✅ Directory: Rename
* ✅ Directory: Move
* ❌ Directory: Copy
* ✅ Directory: Delete
* ❌ Directory: Delete recursively
* ✅ Files: Read
* ✅ Files: Write
* ✅ Files: Add
* ✅ Files: Rename
* ✅ Files: Replace
* ✅ Files: Move
* ✅ Files: Copy
* ✅ Files: Delete

### [CORE] Forms (Read+Write)

- Enables module **Web>Forms**

### [CORE] Help

- Enable module **Help>TYPO3 Manual**

### [CORE] Pages (Read)

- Enable module **Web>Page**
- Enable module **Web>List**
- Tables (Listing): `Page (pages)`, `Category (sys_category)`

#### Allowed excludefields

##### Page

- ❌ 'New' Until (newUntil)
- ❌ Abstract (abstract)
- ❌ Access (fe_group)
- ❌ Alias (alias)
- ❌ Author (author)
- ✅ Backend Layout (subpages of this page) (backend_layout_next_level)
- ✅ Backend Layout (this page only) (backend_layout)
- ❌ Cache Expires (cache_timeout)
- ❌ Cache Tags (cache_tags)
- ❌ Categories (categories)
- ❌ Contains Plugin (module)
- ✅ Description (description)
- ❌ Email (author_email)
- ✅ Files (media)
- ❌ Include Page TSConfig (from extensions) (tsconfig_includes)
- ✅ Include Subpages (extendToSubpages)
- ❌ Is Root of Website (is_siteroot)
- ❌ Keywords (,) (keywords)
- ❌ Last Updated (lastUpdated)
- ✅ Layout (layout)
- ✅ Localization Settings (l18n_cfg)
- ❌ Login Mode (fe_login_mode)
- ✅ Mount Point redirects to mounted page (mount_pid_ol)
- ✅ Navigation Title (nav_title)
- ❌ No Search (no_search)
- ✅ Page enabled in menus (nav_hide)
- ✅ Page visible (hidden)
- ❌ Restrict editing by non-Admins (editlock)
- ✅ Shortcut Mode (shortcut_mode)
- ✅ Show content from this page instead (content_from_pid)
- ✅ Start (starttime)
- ✅ Stop (endtime)
- ❌ Stop page tree (php_tree_stop)
- ✅ Subtitle (subtitle)
- ✅ Target (target)
- ✅ Transl.Orig (l10n_parent)
- ❌ TSconfig (TSconfig)
- ✅ Type (doktype)
- ✅ URL Segment (slug)

### [CORE] Pages (Write)

- Includes `[CORE] Pages (Read)`
- Tables (modify): `Page (pages), Category (sys_category)`
- Page types: `Standard, Backend User Section, Shortcut, Mount Point, Link to External URL, Folder, Recycler, Menu Separator`

### [CORE] User Configuration

Enables module **User tools>User settings**

### [CORE] Workspace

_dummy parent group, might be needed if workspaces are used_

### [CORE] Workspace / Live

Enables Workspace Live

# EXT

All vendor extensions that are not in the T3 core are configured here. Please use `(Read)` and `(Write)` suffix.

### [EXT] News (Read)

List News

### [EXT] News (Write)

Modify News

# LANG

The [LANG] group defines permissions for editors to access only specific content related to the chosen language.

### [LANG] Default

Limit to Language Default

# ROLE

The [ROLE] group is the only group that should be added to an User. The `[Role]` contains all `[LANG],[MOUNT],[EXT]...` Groups that the User needs to work efficiently.

### Example

To keep the structure system clean when generating a new [Role] group you could start with an basic `[ROLE] Editor (Abstract)`. At first you add the language/s `[LANG]` you want to grant access too. Second you add the entrypoints `[MOUNT]`. At last you can add needed extra groups and name your new role in the assembly scheme `[ROLE]` / `[LANG]` / `[MOUNT]`.

### [ROLE] Admin

_Includes TsConfig Backend Configuration for admins:_

`template/Configuration/TsConfig/User/admin.tsconfig`

### [ROLE] Editor (Abstract)

This is the default editor. It includes everything neccessary to set up a basic editor. It is still an abstraction group and won't work on its own, because of the missing DB `[MOUNT]` and missing `[LANG]` groups.

_Includes TsConfig Backend Configuration for editors:_

`template/Configuration/TsConfig/User/editor-default.tsconfig`

Includes the following groups:

- `[CORE] Pages (Write)`
- `[CORE] Files`
- `[CORE] Forms (Write)`
- `[CORE] User Configuration`
- `[CORE] Content (Write)`
- `[CORE] Help`
- `[CORE] Workspace / Live`
- `[ACCESS] Default`

**Note:**
No (Read) groups are included here. (Read) groups are included in the (Write) groups with the same name.

### [ROLE] Editor / Language (All) / Root Default Page

- Includes `[ROLE] Editor (Abstract)`
- Includes `[MOUNT] Root Default Page`

### [ROLE] Editor / Language (Default) / Root Default Page

- Includes `[ROLE] Editor (Abstract)`
- Includes `[MOUNT] Root Default Page`
- Includes `[LANG] Limit to Default`
